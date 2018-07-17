# 上传文件

composer require wubuze/upload-file


app\config\app.php 文件中provider 加上

UploadFile\UfffServiceProvider::class,

php artisan vendor:publish
生成的storage.php 文件里面可以配置文件上传路径

php artisan storage:link

迁移数据库,创建model
php artisan migrate 生成表 file、file_group

创建 App\Model\File 必须继承 UploadFile\Model\File\File 
创建 App\Model\FileGroup 继承 UploadFile\Model\File\FileGroup

上传文件 
use UploadFile\File\Uploader;
$module = config('storage.'.$req->input('module')); if (!$module) { return 'error'; }

Uploader::init($req->file('file')); 
$file = Uploader::upload($module['dir'], $req->input('fileName'), $module['public']); 
$file->setUrl();

return @[ 'id' => $file->id, 'url' => $file->url, 'top' => $file->top, 'name' => $file->file.'.'.$file->type, ];