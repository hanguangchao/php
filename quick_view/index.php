<?php 
date_default_timezone_set("Etc/GMT-8");

function getUserIP()
{
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
}


$ip = getUserIP();
$ip2long = ip2long($ip);

$get_ip = '';
$get_ip_long = ''; 
$iplong = '';
$long2ip = '';
if (isset($_GET['ip'])) {
    $get_ip = $_GET['ip'];
    $get_ip_long = ip2long($get_ip);
}

if (isset($_GET['iplong'])) {
    $iplong = $_GET['iplong'];
    $long2ip = long2ip($iplong);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>t</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >
<div class="container">
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">时间戳</h3>
              </div>
              <div class="panel-body" style="min-height: 146px;">
                    <form class="form-inline" id="timestamp_app">
                        <div class="form-group">
                            <p class="form-control-static">时间戳：</p>
                         </div>
                        <div class="form-group">
                            <input type="text" v-model="timestamp" id="timestamp" v-on:blur="post" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <p class="form-control-static">日&nbsp;&nbsp;&nbsp;期：</p>
                         </div>
                        <div class="form-group">
                            <input type="text" v-model="result" class="form-control"/>
                        </div>
                    </form>
                    <form class="form-inline" id="date_app" style="margin:12px;">
                        <div class="form-group">
                            <p class="form-control-static">日期：</p>
                         </div>
                        <div class="form-group">
                                <input type="text" v-model="datetime" id="datetime" v-on:blur="post" class="form-control" value="<?php echo date('Y-m-d H:i:s', time()); ?>" />
                        </div>
                        <div class="form-group">
                            <p class="form-control-static">时间戳：</p>
                         </div>
                        <div class="form-group">
                            <input type="text" v-model="result" class="form-control" value="<?php echo time();?>" />
                        </div>
                  </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Ip</h3>
          </div>
          <div class="panel-body">
            <form method="get" action="index.php">
            <p>user-ip：<input type="text" value="<?php echo $ip;?>" /></p>
            <p>ip2long：
                <input type="text" value="<?php echo $get_ip;?>" name="ip"/> >> <input type="text" value="<?php echo $get_ip_long;?>"/>

            </p>

            <p>long2ip：<input type="text" value="<?php echo $iplong;?>" name="iplong"/> >> IP Addr
                <input type="text" value="<?php echo $long2ip;?>"/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </p>
        </form>
          </div>
        </div>
    </div>


    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title">Encrypt/Decrypt</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline" id="md5_app">
              <div class="form-group">
                <p class="form-control-static">Str To Md5</p>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="String" name="string" v-model="string" v-on:click="post">
                <input type="text" class="form-control" placeholder="Salt" name="salt" v-model="salt"  v-on:click="post"> = 
                <input type="text" class="form-control" id="md5_result" placeholder="=Md5(String.Salt)" v-model="result" style="min-width: 300px;">
                <input type="checkbox" class="form-control" true-value="1" v-model="caps" v-on:click="post"> 大写

              </div>
            </form>

            <form class="form-inline">
              <div class="form-group">
                <p class="form-control-static">随机密码</p>
              </div>
              <div class="form-group">
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox1" value="1" checked="checked"> A-Z
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox2" value="2" checked="checked"> a-z
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox3" value="3"> 0-9
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox4" value="4"> !@#$%^&*
                </label>
                <select class="form-control">
                  <option>4</option>
                  <option>6</option>
                  <option selected="selected">8</option>
                  <option>16</option>
                  <option>32</option>
                </select>
              </div>
               <input type="text" class="form-control" placeholder="Password" value="" readonly="readonly">
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        </div>
    </div>

    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title">Url Encode／Decode/Base64 Encode/Base64 Decode</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline">
              <div class="form-group">
                <p class="form-control-static">Url Encode </p>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Url Encode ">
                <input type="text" class="form-control" placeholder="">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
              <div>
                <div class="form-group">
                <p class="form-control-static">Url Decode </p>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Url Decode ">
                <input type="text" class="form-control" placeholder="">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
             </div>

             <div>
                <div class="form-group">
                <p class="form-control-static">Base64 Encode </p>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Base64 Encode ">
                <input type="text" class="form-control" placeholder="">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
             </div>

             <div>
                <div class="form-group">
                <p class="form-control-static">Base64 Decode </p>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Base64 Decode ">
                <input type="text" class="form-control" placeholder="">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
             </div>

             <div>
                <div class="form-group">
                <p class="form-control-static">Base64 Image </p>
              </div>
              <div class="form-group">
                <div class="col-sm-12 col-md-12">
                <textarea type="text" class="form-control" placeholder="Base64 Image  " style="margin: 0px; width: 325px; height: 288px;"></textarea>
                 <a href="javascript:void(0)"><img src="http://www.runoob.com/wp-content/uploads/2014/06/kittens.jpg" /></a>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">Submit</button>
              </div>
              
             </div>
            </form>
        </div>
        </div>
    </div>
</div>



<main class="row-fluid" style="height:60%;min-height:350px;" id="json_app">
    <div>JSON-View</div>
    <div class="row"><div class="col-md-5" style="padding:0px;height:100%;">
        <textarea name="json" v-model="json" v-on:blur="post" class="form-control" style="height:100%;height: 87vh;min-height:350px;border:solid 1px #E5EBEE;border-radius:0;resize: none; outline:none;font-size:10px;"></textarea>
    </div>
    <div class="col-md-7" style="padding:0;position:relative;height:100%;">
        <textarea  v-model="result" style="width:100%;height: 87vh;min-height:350px;border:solid 1px #f6f6f6;border-radius:0;resize: none;overflow-y:scroll; outline:none;position:relative;font-size:12px;" class="form-control" disabled>
        </textarea>
    </div>
    </div>
    <div><button type="button" class="btn btn-primary" v-on:click="post">Submit</button></div>
</main>
</div>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
 
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.staticfile.org/vue/2.4.2/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>


<script>

new Vue({
    el: '#timestamp_app',
    data: {
        timestamp:'<?php echo time(); ?>',
        result:'<?php echo date('Y-m-d H:i:s', time()); ?>'
    },
    methods:{
        post:function(){
            if (this.string == '') return;
            //发送 post 请求
            this.$http.post('./app.php',{timestamp:this.timestamp, app:"timestamp_app"},{emulateJSON:true}).then(function(res){
                result = res.data.data;
                this.result = result;
                return;
            },function(res){
                console.log(res.status);
            });
        }
    }
});
new Vue({
    el: '#date_app',
    data: {
        datetime : '<?php echo date('Y-m-d H:i:s', time()); ?>',
        result :'<?php echo time(); ?>',
    },
    methods:{
        post:function(){
            if (this.string == '') return;
            //发送 post 请求
            this.$http.post('./app.php',{datetime:this.datetime, app:"date_app"},{emulateJSON:true}).then(function(res){
                result = res.data.data;
                this.result = result;
                return;
            },function(res){
                console.log(res.status);
            });
        }
    }
});
new Vue({
    el: '#md5_app',
    data: {
        string: '',
        salt: '',
        result:'',
        caps : 0,
    },
    methods:{
        post:function(){
            if (this.string == '') return;
            //发送 post 请求
            this.$http.post('./app.php',{string:this.string,salt:this.salt, caps: this.caps, app:"md5_app"},{emulateJSON:true}).then(function(res){
                result = res.data.data;
                this.result = result;
                return;
            },function(res){
                console.log(res.status);
            });
        }
    }
});

new Vue({
    el: '#json_app',
    data: {
        json   :'',
        result :''
    },
    methods:{
        post:function(){
            if (this.string == '') return;
            //发送 post 请求
            this.$http.post('./app.php',{json:this.json, app:"json_app"},{emulateJSON:true}).then(function(res){
                result = res.data.data;
                this.result = result;
                return;
            },function(res){
                console.log(res.status);
            });
        }
    }
});
</script>


</body>
</html>



