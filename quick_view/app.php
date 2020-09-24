<?php

if(isset($_POST['app'])){
    switch ($_POST['app']) {
        case 'timestamp_app':
            $timestamp = intval($_POST['timestamp']);
            $ret = json_encode(['code' => 0 , 'data' => date('Y-m-d H:i:s', $timestamp), ]);
            echo $ret;
            exit;
            break;
        case 'date_app':
            $datetime = intval($_POST['datetime']);
            $ret = json_encode(['code' => 0 , 'data' => strtotime($datetime), ]);
            echo $ret;
            exit;
            break;
        case 'md5_app':
            $caps = isset($_POST['caps']) ? intval($_POST['caps']) : 0;
            $hash = md5($_POST['string'] . $_POST['salt']);
            if ($caps) {
                $hash = strtoupper($hash);
            }
            $ret = json_encode(['code' => 0 , 'data' => $hash, ]);
            echo $ret;
            exit;
            break;
        case 'json_app':
            $json_text = $json_text_pretty = '';
            $json_text = $_POST['json'];
            $json_text_pretty = json_encode(json_decode($json_text, true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $ret = json_encode(['code' => 0 , 'data' => $json_text_pretty, ]);
            echo $ret;
            exit;
        default:
            # code...
            break;
    }
}
