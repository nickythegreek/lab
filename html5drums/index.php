<?
/*
 * HTML 5 Drum Kit
 * Copyright (c) 2009 Brian Arnold
 * Software licensed under MIT license, see http://www.randomthink.net/lab/LICENSE
 * Original drum kit samples freely used from http://bigsamples.free.fr/
 * Current drum kit samples generated using GarageBand,
 * see below for Creative Commons licensing
 */
// A function to process and echo out a list
function scanForSounds($path) {
	// Set up a return value
	$return = '';
	
	// Set up to save files
	$files = array();
	$dirs = array();

	// Open up the directory
	if ($handle = opendir($path)) {
		while (($file = readdir($handle)) !== false) {
			// Skip anything hidden
			if (substr($file, 0, 1) == '.') continue;
			// If it's not a .wav, skip on
			if (substr($file, -4) != '.wav') continue;
			$fullpath = "$path/$file";
			if (is_dir($fullpath)) {
				$dirs[] = $fullpath;
			} else {
				// Store for handling!
				$files[] = $file;
			} // if (is_dir($file))
		} // while (($file = readdir($handle)) !== false)

		// Sort the file listing for cleanness sake
		asort($files);
		foreach ($files as $f) {
			// Get a clean name for the title later
			$basename = basename($f, '.wav');
			// Use that to make a clean-ish ID
			$elem_id = preg_replace('/\s+/', '_', strtolower($basename));
			// Build a couple of paths
			$oggpath = "$path/$basename.ogg";
			$mp3path = "$path/$basename.mp3";
			$wavpath = "$path/$basename.wav";
			$aifpath = "$path/$basename.aif";
			// Set it up as a full-on audio object
			//$return .= "<audio id=\"sound_$elem_id\" title=\"$basename\" src=\"$wavpath\" autobuffer><!--<source src=\"$aifpath\" type=\"audio/x-aiff\"><source src=\"$wavpath\" type=\"audio/x-wav\">--></audio>\n";
			$return .= "<audio id=\"sound_$elem_id\" title=\"$basename\" autobuffer><source src=\"$wavpath\" type=\"audio/x-wav\"><source src=\"$oggpath\" type=\"application/ogg\"><source src=\"$mp3path\" type=\"audio/mpeg\"></audio>\n";
		} // foreach ($files as $f)
		
		asort($dirs);
		foreach ($dirs as $d) {
			// Scan the path, add it in
			$return .= scanForSounds($d);
		} // foreach ($dirs as $d)
	} // if ($handle = opendir($path))

	// Hand it back
	return $return;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>HTML5 Drum Kit | RandomThink Labs</title>
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
			<aside id="blather">
				<p>Note: Currently works best in FF on Win/Lin and Safari on Mac. Chrome is just funky, so I'm exploring that soon.</p>
				<p>Thanks for stopping by! I really appreciate it. I'm glad this tool has been so well received.</p>
			</aside> <!-- #blather -->
		</section> <!-- #content -->
		<section id="sounds">
			<?= scanForSounds('drumkit'); ?>
		</section>
		<footer>
			<p>HTML5 Drum Kit by <a href="http://www.randomthink.net/">Brian Arnold</a>, MIT licensed so snag away</p>
			<p><a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/us/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/us/88x31.png" /></a><br />All audio sounds for <span xmlns:dc="http://purl.org/dc/elements/1.1/" href="http://purl.org/dc/dcmitype/Sound" rel="dc:type">HTML5 Drum Kit</span> are licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/us/">Creative Commons Attribution-Noncommercial 3.0 United States License</a>. Created using the standard Hip Hop Drum Kit in GarageBand.</p>
		</footer>
		<script type="text/javascript" src="html5drums.js"></script>
		<!-- Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-279164-1");
pageTracker._trackPageview();
} catch(err) {}</script>	
	</body>
</html>
