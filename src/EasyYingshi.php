<?php
/**
 * Created by PhpStorm.
 * User: zhangxiaomin
 * Date: 2016/12/29
 * Time: 下午2:24
 */

namespace Shawn\YSCamera;


class EasyYingshi
{
    /**
     * 获取用户的accessToken
     * @return mixed
     */
    public function getAccessToken()
    {
        $data=array('appKey'=>env('YS_APP_KEY',''),'appSecret'=>env('YS_APP_Secret',''),);
        //初始化curl;
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,"https://open.ys7.com/api/lapp/token/get");//这是请求地址
        //设置返回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //设置post请求方式
        curl_setopt($ch,CURLOPT_POST,1);
        //设置post提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 添加设备
     * @param $deviceSerial,设备序列号
     * @param $validateCode,设备验证码，设备机身上的六位大写字母
     * @return mixed|string
     */
    public function addDevice($deviceSerial,$validateCode)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/add');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,'deviceSerial'=>$deviceSerial,'validateCode'=>$validateCode));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 删除设备
     * @param $deviceSerial,设备序列号
     * @return mixed|string
     */
    public function deleteDevice($deviceSerial)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/delete');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,'deviceSerial'=>$deviceSerial));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }


    /**
     * 修改设备名称
     * @param $deviceSerial,设备序列号
     * @param $deviceName,设备名称，长度不大于50字节，不能包含特殊字符
     * @return mixed|string
     */
    public function renameDevice($deviceSerial,$deviceName)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/name/update');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,'deviceSerial'=>$deviceSerial,'deviceName'=>$deviceName));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 抓拍设备当前画面，该接口仅适用于IPC或者关联IPC的NVR设备
     * @param $deviceSerial,设备序列号
     * @param $channelNo,	通道号，IPC设备填写1
     * @return mixed|string
     */
    public function deviceCapture($deviceSerial,$channelNo)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/capture');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,'deviceSerial'=>$deviceSerial,'channelNo'=>$channelNo));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 该接口用于NVR设备关联IPC
     * @param $deviceSerial,设备序列号
     * @param $ipcSerial,待关联的IPC设备序列号
     * @param null $channelNo,	非必选参数，不为空表示给指定通道关联IPC，为空表示给通道1关联IPC
     * @param null $validateCode,非必选参数，IPC设备验证码，默认为空
     * @return mixed|string
     */
    public function ipcAdd($deviceSerial,$ipcSerial,$channelNo=null,$validateCode=null)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/capture');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'deviceSerial'=>$deviceSerial,
            'ipcSerial'=>$ipcSerial,
            'channelNo'=>$channelNo,
            'validateCode'=>$validateCode));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 该接口用于NVR设备解除关联IPC
     * @param $deviceSerial:设备序列号
     * @param $ipcSerial:待关联的IPC设备序列号
     * @param $channelNo:非必选参数，不为空表示给指定通道关联IPC，为空表示给通道1关联IPC
     * @return mixed|string
     */
    public function ipcDelete($deviceSerial,$ipcSerial,$channelNo=null)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/ipc/delete');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'deviceSerial'=>$deviceSerial,
            'ipcSerial'=>$ipcSerial,
            'channelNo'=>$channelNo));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }


    /**
     * 查询用户下设备基本信息列表
     * @param int $pageStart,分页起始页，从0开始
     * @param int $pageSize,分页大小，默认为10，最大为50
     * @return mixed|string
     */
    public function deviceList($pageStart=0,$pageSize=10)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/list');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'pageStart'=>$pageStart,
            'pageSize'=>$pageSize));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * deviceSerial
     * @param $deviceSerial:设备序列号
     * @return mixed|string
     */
    public function deviceInfo($deviceSerial)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/info');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'deviceSerial'=>$deviceSerial));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 获取监控点摄像头列表
     * @param int $pageStart,分页起始页，从0开始
     * @param int $pageSize,分页大小，默认为10，最大为50
     * @return mixed|string
     */
    public function cameraList($pageStart=0,$pageSize=10)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/camera/list');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'pageStart'=>$pageStart,
            'pageSize'=>$pageSize));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 该接口用于互联互通设备根据UUID查询抓拍的图片
     * @param $uuid:设备sdk抓拍返回的uuid
     * @param $size:图片大小,范围在【0-1280】
     * @return mixed|string
     */
    public function uuidPicture($uuid,$size)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/device/uuid/picture');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'uuid'=>$uuid,
            'size'=>$size));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     *  获取用户下直播视频列表
     * @param int $pageStart,分页起始页，从0开始
     * @param int $pageSize,分页大小，默认为10，最大为50
     * @return mixed|string
     */
    public function videoList($pageStart=0,$pageSize=10)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/live/video/list');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'pageStart'=>$pageStart,
            'pageSize'=>$pageSize));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

    /**
     * 获取指定有效期的直播地址
     * @param $deviceSerial:设备序列号
     * @param $channelNo:通道号，IPC设备填1
     * @param $expireTime:地址过期时间：单位秒数，最大默认2592000（即30天），最小默认300（即5分钟）
     * @return mixed|string
     */
    public function liveAddressLimited($deviceSerial,$channelNo,$expireTime=300)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $ch=curl_init();
        //设置放回请求结果
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //请求地址
        curl_setopt($ch,CURLOPT_URL,'https://open.ys7.com/api/lapp/live/video/list');
        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,array('accessToken'=>$token,
            'deviceSerial'=>$deviceSerial,
            'channelNo'=>$channelNo,
            'expireTime'=>$expireTime));
        //执行请求
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }


    /**
     * 获取客流统计开关状态
     * @param $deviceSerial:设备序列号
     * @return mixed|string
     */
    public function passengerFlowSwitchStatus($deviceSerial)
    {
        //获取accesstoken
        $accessRespone=json_decode($this->getAccessToken());
        if ($accessRespone->code!="200")
        {
            return json_encode($accessRespone);
        }
        $token=$accessRespone->data->accessToken;

        $post_url="https://open.ys7.com/api/lapp/passengerflow/switch/status";
        $post_data=array('accessToken'=>$token,'deviceSerial'=>$deviceSerial);

        $ch=curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_URL,$post_url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        $respone=curl_exec($ch);
        curl_close($ch);
        return $respone;
    }

}