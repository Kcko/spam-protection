<!doctype html>
<html lang="cs">
<head>
	<meta charset="UTF-8" />
	<title>Test proti spamu</title>
	<style>
		.nod {display: none;}
	</style>
</head>
<body>


<? 

	if (!empty($_POST))
	{


		$hiddenFields = array("url", "add", "message", "email");
		foreach ($hiddenFields as $field) 
		{
			// 1 test na skryta pole, ty normalni uzivatel nemuze vyplnit
			if ($_POST[$field] != "")
			{
				die("Jste robot! (hidden fields)");
			}
		}
		
		// 2 test na prvni skryty submit, robot odesila vetsinou prvni submit input
		if ($_POST["submit"] != "")
		{
			die("Jste robot! (hidden submit)");
		}

		// 3 test input vygenerovany pres JS, JS robot neprecte a kdo ho ma vyply 
		//   tak se mu zobrazi pres znacku noscript

		if ($_POST["robot"] != 20)
		{
			die("Jste robot! (js kontrola nebo neumíte počítat :D)");
		}

		echo "<pre>" . print_r($_POST, TRUE) . "</pre>";
		echo "Jste človek - dalsi pokracovani aplikace";
	}


	//
?>
	
<form action="" method="post">

	<!-- Libovolne, na tohle se nejcasteji chytaji roboti -->
	<input type="hidden" name="url" />
	<input type="hidden" name="add" />
	<input type="hidden" name="message" />
	<input type="hidden" name="email" />

	<!-- Vygenerovany input pres JS -->
   <script type="text/javascript">
        document.write('<input type="hidden" name="robot" value="'+(10 + 15)+'" />');
    </script>

	
	<p>
		<label for="name">Jméno</label>
		<input type="text" name="name" id="name" />
	</p>

	<!-- Tohle se pouzije v pripade ze ma clovek vyply JS a musi to vyplnit ruco -->
	<noscript>
	<p>
		<label for="robot">Ochrana proti spamu, doplňte výsledek 10 + 15 = </label>
		<input type="text" name="robot" id="robot" />
	</p>
	</noscript>

	<p class="nod">
		<label></label>
		<input type="submit" name="submit" value="Odeslat" />
	</p>	

	<p>
		<label></label>
		<input type="submit" name="submit2" value="Odeslat" />
	</p>
</form>


</body>
</html>