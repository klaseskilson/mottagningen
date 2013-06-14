/**
 * requestAnimationFrame polyfill by Erik Mller
 * fixes from Paul Irish and Tino Zijdel
 *
 * http://paulirish.com/2011/requestanimationframe-for-smart-animating/
 * http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
 */

// how often should the background refresh?
var bgupdateinterval = 15*1000, // every 15 seconds
	mainduskduration = 30*60,	// 30 minuits
	pageload = Math.floor(Date.now()/1000); // when was the page opened?
// get vendor prefix
var gradientPrefix = getCssValuePrefix('backgroundImage',
									   'radial-gradient(center, circle cover, #fff 0%, #fff 100%)');

(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
        								|| window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

function init()
{
	(function(){
		if(!Array.prototype.indexOf)
			Array.prototype.indexOf = function(obj){for(var i=0;i<this.length;i++){if(this[i]===obj){return i;}}return -1;};
		var isAgent = function(agent){return navigator.userAgent.indexOf(agent) >= 0 ? true:false;};
		if(!(isAgent('Mobile') || isAgent('Android'))){
			addClouds();
			animateClouds();
			// set colors at load and init continuous color change
			setcolor();
			initcolor(bgupdateinterval);
		}
	})(this);
}

function detectTransformProperty () {
	var prefixes = 'transform WebkitTransform MozTransform oTransform msTransform'.split(' '),
		el = document.createElement('div'),
		index = 0;

	while (index < prefixes.length) {
		var prefix = prefixes[index++];
		if (document.createElement('div').style[prefix] !== undefined) {
			return prefix;
		}
	}

	return false;
}

function getCssValuePrefix(name, value) {
    var prefixes = ['-webkit-', '-moz-', '-ms-', '-o-'];
    var prefix = '';

    // Create a temporary DOM object for testing
    var dom = document.createElement('div');

    for (var i = 0; i < prefixes.length; i++) {
        // Attempt to set the gradient
        dom.style[name] = prefixes[i] + value;

        // Detect if the gradient was successfully set
        if (dom.style[name]) prefix = prefixes[i];

        dom.style[name] = '';   // Reset the gradient
    }
    return prefix;
}

function addClouds()
{
	var count = 10,
		shouldanimate = true;

	var cloudsDiv = document.getElementById("clouds");

	if(shouldanimate)
	{
		cloudsDiv.className = "animate";
	}

	for(var i = 0; i < count; i++)
	{
		var cloud = new Image();
		cloud.src = "/web/img/clouds/cloud" + i + ".png";
		cloud.className = "cloud";
		cloud.id = "cloud" + i;
		cloud.style.left = parseInt(Math.random() * 0)+'px';
		cloud.style.top = parseInt(Math.random() * 200)+'px';
		cloud.style.opacity = 0.9;

		cloudsDiv.appendChild(cloud);
	}
}

function animateClouds()
{
	var transformProperty = detectTransformProperty();

	// kolla om klient stödjer transformproperty
	if(!transformProperty)
	{
		//avsluta animateClouds()
		return;
	}

	// leta upp clouds-diven
	var cloudsDiv = document.getElementById("clouds");

	// leta upp barnen, spara till array
	var clouds = cloudsDiv.childNodes;

	// inställningar!
	var tDuration = 100000;
	var rFastDuration = 10000;
	var rMedDuration = 15000;
	var rSlowDuration = 20000;
	var rDurations = [rFastDuration, rMedDuration, rSlowDuration, rSlowDuration, rMedDuration, rSlowDuration, rFastDuration, rMedDuration, rSlowDuration, rFastDuration, rMedDuration, rSlowDuration];
	var rDirections = [1, -1, 1, 1, -1, -1, 1, 1, -1, -1, -1, 1];
	var tOffsets = [0, 0.1, 0.15, 0.3, 0.36, 0.5, 0.56, 0.75, 0.7, 0.82, 0.89, 0.94];
	var yOffsets = [0, 70, 0, 80, 20, 30, -40, 70, 20, 10, -50, 20];
	var xspeed = [0.7, 0.8, 0.7, 1, 1, 0.8, 0.9, 0.8, 0.85, 0.95];

	var animate = function(){
		for(var i = 0; i < clouds.length; i++)
		{
			var cloud = clouds[i];
			var rDuration = rDirections[i];
			var t = (Date.now() / tDuration + tOffsets[i]) % 1;
			var x = 2000 * t;
			var y = 120 + Math.pow(t - 0.5, 2) * 1000 + yOffsets[i];
			var s = Math.min(Math.min(t / 0.1, (1 - t) / 0.1), 1);

			// translateY(" + y + "px)
			cloud.style[transformProperty] = "translateX(" + xspeed[i] * x + "px) scale(" + s + ")";
		}

		requestAnimationFrame(animate);
	};

	animate();

}

function initcolor(updateinterval)
{
	console.log("Updateringsintervall: " +updateinterval + " millisek.");
	console.log("Sunrise: " +sunrise);
	console.log("Sunset: " +sunset);
	setInterval(setcolor, updateinterval);
}

/**
 *	Please close you eyes, it's about to get ugly.
 */
function setcolor(updateinterval, duskduration)
{
	// default value fix
	updateinterval = updateinterval || bgupdateinterval;
	duskduration = duskduration || mainduskduration; // dusk lasts for 30 minuites

		// save time in handy variable
	var time = Math.floor(Date.now()/1000)%86400,
		// seconds until sunset, (86400) = seconds of a day
		tilsunset = (sunset%86400) - time,
		// seconds until sunrise
		tilsunrise = (sunrise%86400) - time,
		// save background object to var
		background = document.getElementById("background");

	tilsunset = tilsunset < 0 ? tilsunset + 86400 : tilsunset;
	tilsunrise = tilsunrise < 0 ? tilsunrise + 86400 : tilsunrise;

	// DAY -> SUNSET!
	if (tilsunset < duskduration)
	{
		console.log("day->sunset");
		progress = 1-(tilsunset / duskduration);
		lineargradient(sunsetdark, sunsetlight, daydark, daylight, progress, background);
	}
	// SUNSET -> NIGHT
	else if (tilsunset > 86400-duskduration)
	{
		console.log("sunset->night");
		progress = ((86400-tilsunset) / duskduration);
		lineargradient(nightdark, nightlight, sunsetdark, sunsetlight, progress, background);
	}
	// NIGHT -> SUNRISE
	else if (tilsunrise < duskduration)
	{
		console.log("night->sunrise");
		progress = 1-(tilsunrise / duskduration);
		lineargradient(sunsetdark, sunsetlight, nightdark, nightlight, progress, background);
	}
	// SUNRISE -> DAY
	else if (tilsunrise > 86400-duskduration)
	{
		console.log("sunrise->day");
		progress = ((86400-tilsunrise) / duskduration);
		lineargradient(daydark, daylight, sunsetdark, sunsetlight, progress, background);
	}
}

function lineargradient(todark, tolight, fromdark, fromlight, progress, theobject)
{
	// from + progress(to - from)
	var newdark = [ Math.floor(fromdark[0]+progress*(todark[0]-fromdark[0])),
					Math.floor(fromdark[1]+progress*(todark[1]-fromdark[1])),
					Math.floor(fromdark[2]+progress*(todark[2]-fromdark[2]))]
		newlight = [Math.floor(fromlight[0]+progress*(tolight[0]-fromlight[0])),
					Math.floor(fromlight[1]+progress*(tolight[1]-fromlight[1])),
					Math.floor(fromlight[2]+progress*(tolight[2]-fromlight[2]))];
	theobject.style.backgroundImage = gradientPrefix + "radial-gradient(50% 50%, circle cover, rgb("+newlight[0]+","+newlight[1]+", "+newlight[2]+") 0%, rgb("+newdark[0]+","+newdark[1]+", "+newdark[2]+") 100%)";

	console.log("Redrawing: " + newdark + " -> " + newlight);
}
