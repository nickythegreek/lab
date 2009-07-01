// Kember Identity, using some pieces of Stephen McCarthy's solution, worker-style
importScripts('../js/md5-min.js');

var hexChars = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e', 'f'];
var found = false;
var numProcessed = 0;
var kID = -1;
 
function generateRandomHash() {
	var buffer = [];
	for (var i = 0; i < 32; i++) {
		buffer.push(hexChars[Math.floor(Math.random() * 16)]);
	} // for (var i = 0; i < 32; i++)
	return buffer.join('');
}

function checkHash(e) {
	if (kID < 0) {
		kID = parseInt(e.data);
	}
	var newhash = generateRandomHash();
	numProcessed++;
	postMessage("Hash from " + kID + ": " + newhash);
	if (numProcessed < 10) {
		setTimeout(checkHash, 100);
	} else {
		postMessage(kID + " is done!");
	}
}

onmessage = checkHash;