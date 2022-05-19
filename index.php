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
        use EzForm\FormFields;
        use EzForm\FormTag;
        use EzForm\InputTag;

		spl_autoload_register( function ($class) {
			$class = str_replace('\\','/',$class) .'.php';
			require_once $class;
		});


        $formTag = (new FormTag())->addAttr([
            'id'=>'toto',
            'class'=>'simpleForm color-blue',
            'method'=>'POST'
        ]);

        $fields = (new FormFields())
            ->addField((new InputTag())->addAttr(['name'=>'email']))
            ->addField((new InputTag())->addAttr(['type'=>'password', 'name'=>'pwd']))
            ->addField((new InputTag())->addAttr(['type'=>'submit', 'value'=>'Send']));



        $formBuilder = new FormBuilder($formTag, $fields);

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