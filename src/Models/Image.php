<?php namespace Ognestraz\Admin\Models;

use URL;
use Img;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model {

    use SoftDeletes, Traits\Act, Traits\Sortable, Traits\Path, Traits\File;
    
    protected $table = 'images';
    protected $visible = array(
        'id',
        'name',
        'description',
        'filename',
        'path'
    );

    public $imageDir = 'public/image/';
    public $imageDirSrc = '/image/';
    
    static public $rules = array(
        'path' => 'unique:images,path,{id},id'
    );
    
    protected $variants = [
        'original' => [],        
        'icon' => [
            ['fit' => ['width' => 100, 'height' => 100]]
        ],
        'large' => [
            ['fit' => ['width' => 1280, 'height' => 720]]
        ],
        'preview' => [
            ['fit' => ['width' => 300, 'height' => 200]]
        ]        
    ];    
    
//    static public $messages = array(
//        'file.renameimage' => 'Файл с таким именем уже существует!'
//    );     
    
    public function scopeDefault($query)
    {
        return $query->act()->sort();
    }    
    
    public function getDirectoryPath()
    {
        return base_path() . '/' . $this->imageDir;
    }
    
    public function imageable()
    {
        return $this->morphTo('App\Models\Image', 'model', 'model_id');
    }    
    
    public function delete()
    {
        
        $directoryPath = $this->getDirectoryPath();
        $iterator = new \DirectoryIterator($directoryPath);
        
        foreach ($iterator as $fileinfo) {
            
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                
                $file = $directoryPath.$fileinfo->getFilename().'/'.$this->filename;
                
                if (is_file($file)) {
                    
                    unlink($file);
                    
                }
                
            }
            
        }       
        
        $main_file = $directoryPath.$this->filename;
        
        if (is_file($main_file)) {

            unlink($main_file);

        }        
        
        parent::delete();
        
    }
    
    public function getSettings() 
    {
        
        if (is_object($this->imageable)) {

            $settings = $this->imageable->getSettings();
            if (empty($settings['image'])) {
                $mainPageSettings = App\Models\Site::find(1)->getSettings();
                $settings['image'] = $mainPageSettings['image'];
            }

            return $settings;
        }
        
        return array();
        
    }
    
    protected function _cropImage($img, $item) 
    {
        $width = $item['width'] > $img->width() ? $img->width() : $item['width'];
        $height = $item['height'] > $img->height() ? $img->height() : $item['height'];
        $top = is_numeric($item['top']) ? $item['top'] : null;
        $left = is_numeric($item['left']) ? $item['left'] : null;

        $img->crop($width, $height, $top, $left);        
    }
    
    protected function _resizeImage($img, $item) 
    {
        $width = $item['width'] > $img->width() ? $img->width() : $item['width'];
        $height = $item['height'] > $img->height() ? $img->height() : $item['height'];

        $img->resize($width ? $width : null, $height ? $height : null, function ($constraint) {
            $constraint->aspectRatio();
        });       
    }
    
    protected function _fitImage($img, $item) 
    {
        $img->fit($item['width'] ? $item['width'] : null, $item['height'] ? $item['height'] : null);       
    }
    
    protected function _cropWidthImage($img, $item) 
    {
        $width = $item['width'] > $img->width() ? $img->width() : $item['width'];
        $height = $item['height'] > $img->height() ? $img->height() : $item['height'];
        $top = is_numeric($item['top']) ? $item['top'] : null;
        $left = is_numeric($item['left']) ? $item['left'] : null;

        $img->crop($width, $width > $height ? $height : null, $top, $left);   
    }    
    
    protected function _makeList($img, $item) {
        
        $make = key($item);
        $options = $item[$make];        
        
        switch ($make) {
            case 'resize' : 
                $this->_resizeImage($img, $options);
                break;

            case 'fit' : 
                $this->_fitImage($img, $options);
                break;

            case 'crop' : 
                $this->_cropImage($img, $options);
                break;

            case 'crop-width' :                 
                $this->_cropWidthImage($img, $options);
                break;
        }        
    }
    
    public function saveVariant($img, $variant) 
    {
        $variantMake = $this->variants[$variant];
        foreach ($variantMake as $item) {
            $this->_makeList($img, $item);
        }
        
        $img->save(public_path() . '/image/' . $variant . '/' . $this->path);        
    }
    
    public function show($variant)
    {
        if (!isset($this->variants[$variant])) {
            throw new ModelNotFoundException();
        }
        
        $filename = storage_path().'/app/' . $this->filename;
        $img = Img::make($filename);
        $this->saveVariant($img, $variant);
        
        return $img->response('jpg');
    }    
    
    
    public function getVariants() {
        
        $settings = $this->getSettings();
        return !empty($settings['image']) ? array_keys($settings['image']) : array();
        
    }    
    
    protected function _createVariant($file, $variant) {
        
        $img = Img::make($file);
            
        foreach ($variant['make'] as $k => $make) {

            $item = array('width' => (int)$variant['width'][$k],
                'height' => (int)$variant['height'][$k],
                'top' => (int)$variant['top'][$k],
                'left' => (int)$variant['left'][$k]);


            switch ($make) {

                case 'resize' : {

                    $width = $item['width'] > $img->width() ? $img->width() : $item['width'];
                    $height = $item['height'] > $img->height() ? $img->height() : $item['height'];

                    $img->resize($width ? $width : null, $height ? $height : null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    break;
                }

                case 'fit' : {

                    $img->fit($item['width'] ? $item['width'] : null, $item['height'] ? $item['height'] : null);
                    break;
                }

                case 'crop' : {

                    $width = $item['width'] > $img->width() ? $img->width() : $item['width'];
                    $height = $item['height'] > $img->height() ? $img->height() : $item['height'];
                    $top = is_numeric($item['top']) ? $item['top'] : null;
                    $left = is_numeric($item['left']) ? $item['left'] : null;

                    $img->crop($width, $height, $top, $left);
                    break;

                }

                case 'crop-width' : {

                    $width = $item['width'] > $img->width() ? $img->width() : $item['width'];
                    $height = $item['height'] > $img->height() ? $img->height() : $item['height'];
                    $top = is_numeric($item['top']) ? $item['top'] : null;
                    $left = is_numeric($item['left']) ? $item['left'] : null;

                    $img->crop($width, $width > $height ? $height : null, $top, $left);
                    break;

                }

            }
        }

        return $img;
        
    }
    
    public function setVariantImage($variant) {
        
        $settings = $this->getSettings();
        
        if (!empty($settings['image'][$variant])) {
            
            $fileName = $this->imageDir.$variant.'/'.$this->filename;
            $img = $this->_createVariant($fileName, $settings['image'][$variant]);
            $img->save($fileName);
            
        }

    }
    
    public function variantImage() {

        $settings = $this->getSettings();

        foreach ($settings['image'] as $key => $variant) {
        
            $img = $this->_createVariant($this->imageDir.$this->file, $variant);
         
            if (!is_dir($this->imageDir.$key)) {
                mkdir($this->imageDir.$key);
            }
            
            $img->save($this->imageDir.$key.'/'.$this->file);
            
        }

    }
    
    public function file($part = '', $default = '')
    {
        
        $part_path = $part ? $part.'/' : '';
        $filename = $this->getDirectoryPath().$part_path.$this->filename;
        return is_file($filename) ? $filename : $default;
        
    }
    
    public function src($part = 'original', $default = '')
     {
        
        $part_path = $part ? $part.'/' : '';
        $filename = $this->getDirectoryPath().$part_path.$this->filename;

        return URL::to('/').$this->imageDirSrc.$part_path.$this->path;
        
    }
    
    public function srcNoCache($part = '', $default = '')
    {
        
        return $this->src($part, $default).'?r='.rand();
        
    }

}
