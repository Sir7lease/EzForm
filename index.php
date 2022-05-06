<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class LoaderClass
	{
		public static $listFiles = [];
		public static $subFolder = [];

		public static function arrayDir($pathToBrowse)
		{
			$arrDir = array_diff(scandir($pathToBrowse), array('.', '..'));			
			if(count(self::$subFolder)>0)
			{
				array_shift(self::$subFolder);
				self::getFilesAndFolders($arrDir, $pathToBrowse);
			}
			
		}
		
		public static function getFilesAndFolders($listDir, $currentPath)
		{
			foreach($listDir as $v){
				if( is_file("$currentPath/$v") )
					array_push(self::$listFiles, "$currentPath/$v");
				else
					array_push(self::$subFolder, "$currentPath/$v");
			}
			
			if(count(self::$subFolder)>0) {
				self::arrayDir(self::$subFolder[0]);
			}
		}
	}

	spl_autoload_register( function ($class) {
		LoaderClass::$subFolder[0] = 'EzForm';
		LoaderClass::arrayDir(LoaderClass::$subFolder[0]);
		
		foreach(LoaderClass::$listFiles as $v){
			if ( strpos(basename($v), $class) !== false){
				include("$v");
			}
		}
	});
	
	

	$obj = new FormTag;
	
	$obj->setForm();
	echo "<pre>";
	print_r ( $obj );
	echo "</pre>";
	
	//echo base64_decode($obj->openTagForm);
	  
	  

