<?
// A function to process and echo out a list
function scanForSounds($path) {
	// Set up a return value
	$return = '';

	// Open up the directory
	if ($handle = opendir($path)) {
		while (($file = readdir($handle)) !== false) {
			// Skip anything hidden
			if (substr($file, 0, 1) == '.') continue;
			$fullpath = "$path/$file";
			$elem_id = basename($file, '.wav');
			if (is_dir($fullpath)) {
				// Scan this path, add it in
				$return .= scanForSounds($fullpath);
			} else {
				// If it's not a .wav, skip on
				if (substr($file, -4) != '.wav') continue;
				// Set it up as a full-on audio object
				$return .= "<audio id=\"sound_$elem_id\" src=\"$fullpath\" autobuffer></audio>\n";
			} // if (is_dir($file))
		} // while (($file = readdir($handle)) !== false)
	} // if ($handle = opendir($path))

	// Hand it back
	return $return;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>HTML5 Drum Kit | Brian's Lab</title>
		<link type="text/css" rel="stylesheet" href="../styles/reset.css" />
		<link type="text/css" rel="stylesheet" href="../styles/lab.css" />
		<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/redmond/jquery-ui.css" />
		<link type="text/css" rel="stylesheet" href="html5drums.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7/jquery-ui.min.js"></script>
		<!--[if lte IE 8]>
		<script src="../js/html5.js" type="text/javascript"></script>
		<![endif]-->
	</head>
	<body>
		<header>
			<h1>HTML5 Drum Kit</h1>
		</header>
		<section id="content">
			<section id="drumkit">
				<ul id="lights">
					<li>
						<ul id="tracker" class="soundrow">
							<li class="header">Tracker</li><li class="pip col_0">tracker_0</li><li class="pip col_1">tracker_1</li><li class="pip col_2">tracker_2</li><li class="pip col_3">tracker_3</li><li class="pip col_4">tracker_4</li><li class="pip col_5">tracker_5</li><li class="pip col_6">tracker_6</li><li class="pip col_7">tracker_7</li><li class="pip col_8">tracker_8</li><li class="pip col_9">tracker_9</li><li class="pip col_10">tracker_0</li><li class="pip col_11">tracker_1</li><li class="pip col_12">tracker_2</li><li class="pip col_13">tracker_3</li><li class="pip col_14">tracker_4</li><li class="pip col_15">tracker_5</li>
						</ul>
					</li>
				</ul> <!-- #lights -->
				<ul id="controls">
					<li><button id="soundstart">Start!</button></li>
					<li><button id="clearall">Clear!</button></li>
					<li><button id="reload">Reload from URL!</button></li>
					<li>
						<label>Tempo: <span id="tempovalue"></span> <abbr title="Beats per minute">BPM</abbr></label>
						<div id="temposlider"></div>
					</li>
				</ul> <!-- #controls -->
			</section><!-- #drumkit -->
		</section> <!-- #content -->
		<section id="sounds">
			<?= scanForSounds('sounds'); ?>
		</section>
		<footer>
			<p>HTML5 Drum Kit by Brian Arnold, MIT licensed so snag away</p>
		</footer>
		<script type="text/javascript" src="html5drums.js"></script>
	</body>
</html>
