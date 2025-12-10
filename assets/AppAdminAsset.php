<?php
/**
 * @link http://www.yiiframework.com/
* @copyright Copyright (c) 2008 Yii Software LLC
* @license http://www.yiiframework.com/license/
*/

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAdminAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
			'css/site.css',
	];
	public $js = [
        'assets/admin/js/bootstrap.min.js',
        'assets/admin/js/plugins/metisMenu/jquery.metisMenu.js',
        'assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'assets/admin/js/plugins/dataTables/datatables.min.js',
        'assets/admin/js/plugins/select2/select2.full.min.js',
        'assets/admin/js/plugins/datapicker/bootstrap-datepicker.js',
        'assets/admin/js/jquery.timepicker.js',
        'assets/admin/js/plugins/chartJs/Chart.min.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.1/clipboard.min.js' 
	];
	public $depends = [
			'yii\web\YiiAsset',
			//'yii\bootstrap\BootstrapAsset',
	];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];
}
