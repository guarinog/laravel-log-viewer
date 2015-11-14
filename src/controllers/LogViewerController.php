<?php
namespace Rap2hpoutre\LaravelLogViewer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use yajra\Datatables\Datatables;

class LogViewerController extends \Illuminate\Routing\Controller
{

    public function index()
    {
        $l = \Input::get('l');
        if ($l) {
            LaravelLogViewer::setFile(base64_decode($l));
        }

//        $logs = LaravelLogViewer::all();

        return View::make('laravel-log-viewer::log', [
            'l' => $l,
            'logs' => [],
            'files' => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName()
        ]);
    }

    public function getData()
    {
        if (\Input::get('l')) {
            LaravelLogViewer::setFile(base64_decode(\Input::get('l')));
        }
        $aLogs = LaravelLogViewer::all();
        $log = new Collection();
        foreach($aLogs as $key => $l){
            $l['level'] = '<span class="text-'.$l['level_class'].'"><span class="glyphicon glyphicon-'.$l['level_img'].'-sign" aria-hidden="true"></span>
                            &nbsp;'.$l['level'].'</span>';
            unset($l['level_img']);
            unset($l['level_class']);
            $text = $l['text'];
            $l['text'] = "";
            if($l['stack']) {
                $l['text'] = '<a class="pull-right expand btn btn-default btn-xs" data-display="stack'.$key.'"><span
            class="glyphicon glyphicon-search"></span></a>';
            }
            $l['text'] .= $text;
            if($l['in_file']){
                $l['text'] .= '<br/>'.$l['in_file'];
                unset($l['in_file']);
            }
            if($l['stack']){
                $l['text'] .= '<div class="stack"
            id="stack'.$key.'"
            style="display: none; white-space: pre;">'.$l['stack'].'</div>';
                unset($l['stack']);
            }
            $l['id'] = $key;
            $log->push($l);
        }

        return Datatables::of($log)->make(true);
    }

}
