<html>
	<head>
		<style>body{background-color:darkgray;}</style>
	</head>
	<body>
<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		use EzForm\Form;
        use EzForm\FormBuilder;
        use EzForm\FormTag;

		spl_autoload_register( function ($class) {
			$class = str_replace('\\','/',$class) .'.php';
			require_once $class;
		});


        $formTag = new FormTag();
        $formTag
            ->addAttrId('ezform fjdif')
            ->addAttrClass('simpleForm')
            ->addAttrMethod('POST');

        $formBuilder = new FormBuilder($formTag);

        echo (new Form($formBuilder))->showForm();
				
		
		
		
		
		
		
		
		function pretty($obj): void
		{
			echo "<pre>";
			print_r ( $obj );
			echo "</pre>";
		}
		
?>
	</body>
</html>