<?php

function hostname_dictionary($link)
{
    $service_type = substr($link, 0, 6);
    $dictionary = [
        "VMS_AT" => "http://206.189.81.185/vms-service/",
        "VMS_MS" => "http://206.189.81.185/vms-service/",
        "VMS_PO" => "http://206.189.81.185/vms-service/",
        "VMS_PR" => "http://206.189.81.185/vms-service/",
        "VMS_VE" => "http://206.189.81.185/vms-service/",
    ];
    return $dictionary[$service_type];
}


function curl_get($link = NULL, $data = NULL)
{
    if ($link != null) {
        if ($data != null) {
            $data = http_build_query($data);
        }

        $link = hostname_dictionary($link).$link."?".$data;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            "status_code" => $httpcode,
            "data" => json_decode($output, true)
        ];
    }
    else {
        return NULL;
    }
}

function curl_post($link = NULL, $data = NULL)
{
    if ($link != NULL) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, hostname_dictionary($link).$link);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($data)
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $server_output = json_decode($server_output, true);
        return [
            "status_code" => $httpcode,
            "data" => $server_output
        ];
    }
    else {
        return NULL;
    }
}

function curl_post_file($link = NULL, $data = NULL, $files = null)
{
    if ($link != NULL) {
        if ($files != null) {
            for ($i=0; $i < count($files); $i++) {
                $counter = $i + 1;
                $cfile[$i] = curl_file_create($_FILES[$files[$i]["files_image"]]["tmp_name"],$_FILES[$files[$i]["files_image"]]["type"],basename($_FILES[$files[$i]["files_image"]]["name"]));
                $data[$files[$i]["send_name"]] = $cfile[$i];
            }
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, hostname_dictionary($link).$link);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $server_output = json_decode($server_output, true);
        return [
            "status_code" => $httpcode,
            "data" => $server_output
        ];
    }
    else {
        return NULL;
    }
}

function curl_put($link = NULL, $data = null)
{
    if ($link != NULL && $data != NULL) {
        $data = http_build_query($data);
        $link = $link."?".$data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, hostname_dictionary($link).$link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            "status_code" => $httpcode,
            "data" => json_decode($output, true)
        ];
    }
    else {
        return NULL;
    }
}

function curl_delete($link = NULL, $data = null)
{
    if ($link != NULL && $data != NULL) {
        $data = http_build_query($data);
        $link = $link."?".$data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, hostname_dictionary($link).$link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            "status_code" => $httpcode,
            "data" => json_decode($output, true)
        ];
    }
    else {
        return NULL;
    }
}
