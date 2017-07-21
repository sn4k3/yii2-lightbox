<?php

namespace globaloxs\lightbox;

use yii\base\Widget;
use yii\helpers\Html;

class Lightbox extends Widget {

    public $files = [];

    public function init() {
        LightboxAsset::register($this->getView());
    }

    public function run() {
        $html = '';
        foreach($this->files as $file) {
            if(!isset($file['thumb']) || !isset($file['original'])) {
                continue;
            }
	    $linkOptions=isset($file['linkOptions'])?$file['linkOptions']:[];
            $thumbOptions=isset($file['thumbOptions'])?$file['thumbOptions']:[];

            $img = Html::img($file['thumb'], $thumbOptions);
            $a = Html::a($img, $file['original'], array_merge([
                'data-lightbox' => 'image-' . uniqid(),
                'data-title' => isset($file['title']) ? $file['title'] : '',
            ],$linkOptions));
            $html .= $a;
        }
        return $html;
    }

}
