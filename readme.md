##萤石云
###安装
```sh
composer require shawn/easy_yingshi_camera
```
###使用
在.env文件中添加
```sh
YS_APP_KEY=
YS_APP_Secret=
```
- 创建实例
```sh
$app=new EasyYingshi()
```
- 修改摄像头的名称
```sh
    /**
     * 修改设备名称
     * @param $deviceSerial,设备序列号
     * @param $deviceName,设备名称，长度不大于50字节，不能包含特殊字符
     * @return mixed|string
     */
public function renameDevice($deviceSerial,$deviceName)
```
- 获取指定摄像头的视屏直播地址
```sh
    /**
     * 获取指定有效期的直播地址
     * @param $deviceSerial:设备序列号
     * @param $channelNo:通道号，IPC设备填1
     * @param $expireTime:地址过期时间：单位秒数，最大默认2592000（即30天），最小默认300（即5分钟）
     * @return mixed|string
     */
public function liveAddressLimited($deviceSerial,$channelNo=1,$expireTime=300)
```
- 添加摄像头
```sh
    /**
     * 添加设备
     * @param $deviceSerial,设备序列号
     * @param $validateCode,设备验证码，设备机身上的六位大写字母
     * @return mixed|string
     */
public function addDevice($deviceSerial,$validateCode)
```
- 删除摄像头
```sh
    /**
     * 删除设备
     * @param $deviceSerial,设备序列号
     * @return mixed|string
     */
public function deleteDevice($deviceSerial)
```

- 抓拍摄像头的当前画面
```sh
    /**
     * 抓拍设备当前画面，该接口仅适用于IPC或者关联IPC的NVR设备
     * @param $deviceSerial,设备序列号
     * @param $channelNo,	通道号，IPC设备填写1
     * @return mixed|string
     */
public function deviceCapture($deviceSerial,$channelNo=1)
```
- 获取指定设备的信息
```sh
    /**
     * 获取指定设备的信息
     * @param $deviceSerial:设备序列号
     * @return mixed|string
     */
    public function deviceInfo($deviceSerial)
```

- 获取监控点摄像头列表
```sh
    /**
     * 获取监控点摄像头列表
     * @param int $pageStart,分页起始页，从0开始
     * @param int $pageSize,分页大小，默认为10，最大为50
     * @return mixed|string
     */
    public function cameraList($pageStart=0,$pageSize=10)
```

- 获取用户下直播视频列表
```sh
    /**
     *  获取用户下直播视频列表
     * @param int $pageStart,分页起始页，从0开始
     * @param int $pageSize,分页大小，默认为10，最大为50
     * @return mixed|string
     */
    public function videoList($pageStart=0,$pageSize=10)
```

