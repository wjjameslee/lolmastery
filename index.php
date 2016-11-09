<?php 
session_start();
error_reporting(0); // To check for errors change the parameter to E_ALL
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Catamaran:300,400,600,800" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="js/jquery-2.1.4.js"></script>
    <script>
     $(function () {
        $('#myForm').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'redirect.php',
            data: $('form').serialize(),
            success: function () {
            	location.reload();
            }
          });

        });
        document.getElementById('go').click();
      });
    </script>

  	<style>
	input[type=text] {
    	width: 114px;
    	box-sizing: border-box;
    	border: 2px solid #ccc;
    	border-radius: 4px;
    	font-size: 16px;
    	background-color: white;
    	background-image: url('img/searchicon.png');
    	background-position: 10px 10px;
    	background-repeat: no-repeat;
    	padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
    	transition: width 0.4s ease-in-out;
	}

	input[type=text]:focus {
    	width: 40%;
	}

	div .sb {
		padding-top: 35px;

	}

	select {
		width:9%;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 4px;
		font-size: 13px;
		font-weight:bold;
		background-color: white;
		background-position: 10px 10px;
		background-repeat: no-repeat;
		padding: 12px 20px 12px 40px;
	} /* need to fix this, text is covered up */ 

	#result {
		margin-top: 25px;
		font-size: 12px;
		color: white;
		text-align: center;
		animation: fadein 5s; 
		-moz-animation: fadein 5s;  /* Firefox */
		-webkit-animation: fadein 5s;  /* Safari and Chrome */
		-o-animation: fadein 5s;  /* Opera */
	}

	#popup {
		min-height: 25px;
		position: absolute;
		min-width: 180px;
		max-width: 300px;
		left: 65%;
 	    bottom:22%;
	background: white;
	z-index: 99999;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	box-shadow: rgba(0,0,0,0.3) 3px 3px 5px;
	-moz-box-shadow: rgba(0,0,0,0.3) 3px 3px 5px;
	-webkit-box-shadow: rgba(0,0,0,0.3) 3px 3px 5px;
  padding:15px 10px;
}

	</style>
	<title>Champion Mastery Lookup | League of Legends</title>
</head>
<body>
	<section class="cd-slider-wrapper">
		<ul class="cd-slider">
			<li class="visible">
				<div class="start">
					<a href="http://www.github.com/wjjameslee" class="cd-btn"><span>Mastery Lookup</span></a>
				</div>
			</li>
				
			<li class="return">
				<div>
					<h2>Search Portal</h2>
					<p>Observe your mastered champion, visually!</p>

					<script language="javascript">
					function toggle() {
						var ele = document.getElementById("toggleThis");
						var text = document.getElementById("displayThis");
						if (ele.style.display == "block") {
    							ele.style.display = "none";
								text.innerHTML = "Let me try it!";
  						}
						else {
								ele.style.display = "block";
								text.innerHTML = "hide";
							}
						} 
					</script>

					<a id="displayThis" href="javascript:toggle();" class="cd-btn">Let me try it!</a>
					
					 <!-- Searchbar -->

					<div id="toggleThis"  style="display:none;" class="sb">
					 <ul class="nav">
					 <form id="myForm">
						<li id="search">
								<input type="text" name="summonerName" id="summonerName" placeholder="Search Summoner"/>
								<input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
									
												<select name="region" id="region">

													<option selected="selected" value="na">NA</option>
													<option value="euw">EUW</option>
													<option value="eune">EUNE</option>
													<option value="tr">TR</option>
													<option value="lan">LAN</option>
													<option value="las">LAS</option>
													<option value="br">BR</option>
													<option value="ru">RU</option>
													<option value="oce">OCE</option>
													<option value="kr">KR</option>

												</select>
											
												
												</li>
					   </form>
					  </ul>
					 </div> 
					  <!-- end of searchbar div-->
				</div>
			</li>

			<li class="target">
				<div id="default">

				
					<?php
					if (isset($_SESSION['summonerName'])) {
						
		require_once('php-riot-api.php');
		require_once('FileSystemCache.php');
		$summonerName = ($_SESSION['summonerName']);
		$submittedRegion = ($_SESSION['region']);

		// Determine Platform
		switch ($submittedRegion) {

			case 'na':
				$platform = 'na1';
				$link = "http://na.op.gg/summoner/userName=";
				break;
			case 'euw':
				$platform = 'euw1';
				$link = "http://euw.op.gg/summoner/userName=";
				break;
			case 'eune':
				$platform = 'eun1';
				$link = "http://eune.op.gg/summoner/userName=";
				break;
			case 'tr':
				$platform = 'tr1';
				$link = "http://tr.op.gg/summoner/userName=";
				break;
			case 'las':
				$platform = 'la2';
				$link = "http://las.op.gg/summoner/userName=";
				break;
			case 'lan':
				$platform = 'la1';
				$link = "http://lan.op.gg/summoner/userName=";
				break;
			case 'br':
				$platform = 'br1';
				$link = "http://br.op.gg/summoner/userName=";
				break;
			case 'ru':
				$platform = 'ru';
				$link = "http://ru.op.gg/summoner/userName=";
				break;
			case 'oce':
				$platform = 'oc1';
				$link = "http://oce.op.gg/summoner/userName=";
				break;
			case 'kr':
				$platform = 'kr';
				$link = "http://www.op.gg/summoner/userName=";
				break;
			default:
				$platform = 'na1';
				$link = "http://na.op.gg/summoner/userName=";
		}
		
		$api = new riotapi($submittedRegion);  
		$cache = new riotapi('na', new FileSystemCache('cache/'));

		try {
			$html = '';

			$summonerId = $api->getSummonerId($summonerName);
			$summonerIconId = $api->getSummonerProfileIconId($summonerId);
			$summonerIconURL = "http://ddragon.leagueoflegends.com/cdn/6.9.1/img/profileicon/" .$summonerIconId. ".png";

			// Name of summoner with exact characters, uppercase, lowercase, whitespaces arrangement
			$nameArray = $api->getSummoner($summonerId);
			$actualSummonerName = $nameArray[$summonerId]['name'];

			// Champion Mastery / Details / Images
			$champMastery = $api->getMastery($summonerId, $platform, $submittedRegion);
			if (empty($champMastery)){

				echo '<h3><font color="white">This summoner has no data stored within the API! Please enter another summoner.</font></h3>';
			}

			$bestChampionId = $champMastery[0]['championId'];
			$bestChampPoints = $champMastery[0]['championPoints'];
			$bestMasteryLevel = $champMastery[0]['championLevel'];
			$lastPlayedTime = $champMastery[0]['lastPlayTime'];
			// Change UNIX timestamps to human readable dates
			$lastPlayedDate = date("Y-m-d H:i:s", $lastPlayedTime/1000);
			$now = date("Y-m-d H:i:s");
			$dateThen = new DateTime($lastPlayedDate);
			$dateNow = new DateTime($now);
			$diff = $dateThen->diff($dateNow);
			$minutesSince = $diff->i;
			$hoursSince = $diff->h;
			$daysSince = $diff->d;
			$monthsSince = $diff->m;
			$yearsSince = $diff->y;

			if ($yearsSince == 0 && $monthsSince == 0 && $daysSince == 0 && $hoursSince == 0 && $minutesSince == 0) {
				$lastPlayed = 'Less than a minute= ago';
			}
			if ($yearsSince == 0 && $monthsSince == 0 && $daysSince == 0 && $hoursSince == 0) {
				$fill = ($minutesSince > 1 ? ' minutes ago' : ' minute ago');
				$lastPlayed = $minutesSince.$fill;
			}
			else if ($yearsSince == 0 && $monthsSince == 0 && $daysSince == 0) {
				$fill = ($hoursSince > 1 ? ' hours ago' : ' hour ago');
				$lastPlayed = $hoursSince.$fill;
			}
			else if ($yearsSince == 0 && $monthsSince == 0) {
				$fill = ($daysSince > 1 ? ' days ago' : ' day ago');
				$lastPlayed = $daysSince.$fill;
			}
			else if ($yearsSince == 0) {
				$fill = ($monthsSince > 1 ? ' months ago' : ' month ago');
				$lastPlayed = $monthsSince.$fill;
			}
			else if ($yearsSince != 0) {
				$fill = ($yearsSince > 1 ? ' years ago' : ' year ago');
				$lastPlayed = $yearsSince.$fill;
			}
			
			
			$champDetails = $api->getThisChampion($bestChampionId);
			$bestChampName = $champDetails['name'];
			$bestChampKey = $champDetails['key'];
			$champSkinsArr = $api->getChampionSkins($bestChampionId);
			$numSkins = count($champSkinsArr['skins']);
			
			$num = array();
			for ($i=0; $i<$numSkins; $i++) {
				array_push($num, $i);
			}
			$skinNum = $num[array_rand($num)]; // Randomly generate a skin number from the possible amount of skins drawn by the champion


			if ($bestChampName == "Wukong") { // Database error with Wukong  

				$bestChampTitle = $champDetails['title'];
				$champSplashURL = "http://ddragon.leagueoflegends.com/cdn/img/champion/splash/MonkeyKing_".$skinNum.".jpg";
				$champIconURL = "http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/MonkeyKing.png";

			} else {

				$bestChampTitle = $champDetails['title'];
				$champSplashURL = "http://ddragon.leagueoflegends.com/cdn/img/champion/splash/".$bestChampKey."_".$skinNum.".jpg";
				$champIconURL = "http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/".$bestChampKey.".png";
			}


			try {  // Determine summoner's rank 

				$jsonDetails = $api->getLeague($summonerId, "entry");
				$summonerTier = $jsonDetails[$summonerId][0]['tier'];
				$summonerDivision = $jsonDetails[$summonerId][0]['entries'][0]['division'];
				$result = true;

			
				} catch (Exception $i) {

					if ($i->getMessage() == "NOT_FOUND") {

						$summonerTier = 'UNRANKED';
						$summonerDivision = '';
						$result = true;
					}
					else {

						echo '<h3>Something went wrong. Error Message: '.$i->getMessage().'\n</h3>';
						$result = false;
					}
				};


			// Displaying correct summoner rank icon
			if ($result) {

				$lowercase_sT = strtolower($summonerTier);

				switch ($lowercase_sT) { 
					
					case "unranked":
						$rankIcon = "<img src='img/tier_icons/unranked.png' alt='Rank' width='130' height='130'/>";
						break;
					case "master":
						$rankIcon = "<img src='img/tier_icons/master.png' alt='Rank' width='130' height='130'/>";
						break;
					case "challenger":
						$rankIcon = "<img src='img/tier_icons/challenger.png' alt='Rank' width='130' height='130'/>";
						break;
					default:
						$formatURL = "img/tier_icons/".strtolower($summonerTier)."_".strtolower($summonerDivision).".png";
						$rankIcon = "<img src='".$formatURL."' alt='Rank' width='130' height='130'/>";
					}

				}

			$matchList = $api->getChampionHistory($summonerId, $bestChampionId);  // Only Ranked queue types from Season5 - Preseason 6 - Current Season 6
			$totalGamesPlayed = $matchList['totalGames'];
			try {
			$rankedS6Stats = $api->getStats($summonerId, 'ranked');
			$rankedChampStats = $rankedS6Stats['champions'];
			$masteredStatsArr = array();
			
			
			foreach ($rankedChampStats as &$value) {
				if ($value['id'] == $bestChampionId) {
					array_push($masteredStatsArr, $value);
				}
			}
			unset($value);
			

			$mCh_doubles = $masteredStatsArr[0]['stats']['totalDoubleKills'];
			$mCh_triples = $masteredStatsArr[0]['stats']['totalTripleKills'];
			$mCh_quadras = $masteredStatsArr[0]['stats']['totalQuadraKills'];
			$mCh_pentas = $masteredStatsArr[0]['stats']['totalPentaKills'];
			$mCh_first = $masteredStatsArr[0]['stats']['totalFirstBlood'];
			$mCh_assists = $masteredStatsArr[0]['stats']['totalAssists']; 
			if (empty($masteredStatsArr)) {
				echo '<h3 style="color:white">This summoner has not played ranked games or has not played their most mastered champion into any of their ranked games during Season 6.</h3>';
			}
		}
			catch (Exception $e) {

				//echo "\nThis summoner has not played ranked games or has not played their most mastered champion into any of their ranked games during Season 6.\n";
				
			};

			// Start drawing HTML
			
			$html .= '<img src="'.$summonerIconURL.'" width="85" height="85">';
			$html .= '<p>'. $actualSummonerName . '</p>';
			$html .=  '<div>'.$rankIcon.'<p>'.$summonerTier. ' '. $summonerDivision.'</p>';
			$printName = preg_replace('/\s+/', '+', $actualSummonerName);
			$html .= '<p><a target="_blank" href ='.$link.$printName.'>Summoner Profile</a></br>';
			$html .= '<a href="#" class="cd-btn" onclick="document.getElementById(\'panel\').click();"">Try puzzle</a></p></div>';
			$html .= '<div id="popup"><div class="content">';
			$html .= '<h4 style="color:black">Most Mastered Champion:</h4>';
			$html .= '<p style="color:black">' . $bestChampName . ', ' . $bestChampTitle . '</p>';
			$html .= '<img src="'.$champIconURL.'" width="90" height="90">';
			$html .= '<p style="color:black">Mastery Level: ' . $bestMasteryLevel . '</p>';
			$html .= '<p style="color:black">Last played: <i>'. $lastPlayed . '</i></p>';
			$html .= '<p style="color:black">Total Points: '. $bestChampPoints . '</p></div></div>';
			echo $html;


			} catch (Exception $e) {

				if ($e->getMessage() == "BAD_REQUEST") {
					echo '<h2>Empty summoner input!</h2>';
				}
				else if ($e->getMessage() == "NOT_FOUND") {
					echo '<h2>Summoner not found!</h2>';
					echo '<p>Please double-check the summoner name and region.</p>';
				}
    			else {
    				echo '<h2>Error: ' . $e->getMessage().\n.'</h2>';
    				echo '<h2>Please contact the administrator for help.</h2>';
    			}
			};
		

					}
					else {
						echo '<h2>Champion Stats</h2>';
					    echo '<a href="#" class="cd-btn" onclick="document.getElementById(\'retry\').click();">Nothing is here at the moment</br>Please try again</a>';

					}
					?>
						
				</div>
			</li>

			<li>
				<div>		
					<?php
					$chtml .= '<img id="art" style="display:none" width="50%" height="700" src="'. $champSplashURL. '" alt="Splash Art">';
					$chtml .= '<div id="main" class="main">';
					$chtml .= '<canvas id="puzzle" width="650px" height="650px" style="border:1px solid #d3d3d3;"></canvas>';
					$chtml .= '</div>';
					$chtml .= '<script src="js/puzzle.js"></script>';
					echo $chtml;
					?>
				</div>
			</li>
		</ul> <!-- .cd-slider -->
	
		<ol class="cd-slider-navigation">
			<li class="selected"><a href="#0"><em>Index</em></a></li>
			<li><a id="retry" href="#0"><em>Search</em></a></li>
			<li><a id="go" href="#0"><em>Stats</em></a></li>
			<li id="panel" style="display:none"><a href=""><em>Puzzle</em></a></li>
		</ol> <!-- .cd-slider-navigation -->
		
		<div class="cd-svg-cover" data-step1="M1402,800h-2V0.6c0-0.3,0-0.3,0-0.6h2v294V800z" data-step2="M1400,800H383L770.7,0.6c0.2-0.3,0.5-0.6,0.9-0.6H1400v294V800z" data-step3="M1400,800H0V0.6C0,0.4,0,0.3,0,0h1400v294V800z" data-step4="M615,800H0V0.6C0,0.4,0,0.3,0,0h615L393,312L615,800z" data-step5="M0,800h-2V0.6C-2,0.4-2,0.3-2,0h2v312V800z" data-step6="M-2,800h2L0,0.6C0,0.3,0,0.3,0,0l-2,0v294V800z" data-step7="M0,800h1017L629.3,0.6c-0.2-0.3-0.5-0.6-0.9-0.6L0,0l0,294L0,800z" data-step8="M0,800h1400V0.6c0-0.2,0-0.3,0-0.6L0,0l0,294L0,800z" data-step9="M785,800h615V0.6c0-0.2,0-0.3,0-0.6L785,0l222,312L785,800z" data-step10="M1400,800h2V0.6c0-0.2,0-0.3,0-0.6l-2,0v312V800z">
			<svg height='100%' width="100%" preserveAspectRatio="none" viewBox="0 0 1400 800">
				<title>SVG cover layer</title>
				<desc>an animated layer to switch from one slide to the next one</desc>
				<path id="cd-changing-path" d="M1402,800h-2V0.6c0-0.3,0-0.3,0-0.6h2v294V800z"/>
			</svg>
		</div> <!-- .cd-svg-cover -->
	</section> <!-- .cd-slider-wrapper -->

<script src="js/snap.svg-min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
