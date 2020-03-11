<?php

use \RytoEX\OBS\LogAnalyzer\Log\OBSStudioLog;

class SiteController extends Controller
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($url)
    {
        $obs_log_text = file_get_contents($url);
        // $tmp_obs_log = new \RytoEX\OBS\LogAnalyzer\Log\OBSStudioLog($obs_log_text, 'studio-crash-win');
        $tmp_obs_log = new OBSStudioLog($obs_log_text);
        unset($tmp_obs_log->raw_string);
        unset($tmp_obs_log->raw_string_full);
        unset($tmp_obs_log->win10info);
        unset($tmp_obs_log->loaded_modules_string);
        unset($tmp_obs_log->profiler_string);
        unset($tmp_obs_log->profiler_obj->profiler_lines);
        unset($tmp_obs_log->profiler_obj->init_data);
        unset($tmp_obs_log->profiler_obj->thread_lines);
        echo '<pre>';
        print_r($tmp_obs_log);
        die();
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error=Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }
}
