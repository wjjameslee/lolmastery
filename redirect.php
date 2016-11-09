<?php
		session_start();

		if (isset($_POST['summonerName']) && isset($_POST['region'])) {
			$_SESSION['summonerName'] = $_POST['summonerName'];
			$_SESSION['region'] = $_POST['region'];
						
		}
		if (!isset($_POST['region'])) {
			$_SESSION['summonerName'] = $_POST['summonerName'];
			$_POST['region'] = 'na';
			$_SESSION['region'] = $_POST['region'];
		}
?> 

		