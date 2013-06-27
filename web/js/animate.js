/*
	SETTINGS
*/
var bgupdateinterval = 15*1000, // how often do you want the dusk to redraw?
	duskduration = 30*60;	// how long should the dusk be?
/*
	variables
 */
// get the css prefix for the current client
var cssprefix = getCssPrefix('transform');
// how far, in percent have we come into the day?
var dayprogress = function(){return((Math.floor(Date.now()/1000)%86400)-sunrise)/(sunset-sunrise);};
// how many seconds into the day are we?
var rightnow = function(){return Math.floor(Date.now()/1000)%86400;};
// initiate the suns position
var sun = [50,50];
// the object that we draw the sun and light to
var bg = document.getElementById("background");
// time-related variables used
var rise = (sunrise/86400).toFixed(3),
	risestart = ((sunrise-duskduration)/86400).toFixed(3),
	riseend = ((sunrise+duskduration)/86400).toFixed(3),
	set = (sunset/86400).toFixed(3),
	setstart = ((sunset-duskduration)/86400).toFixed(3),
	setend = ((sunset+duskduration)/86400).toFixed(3),
	dusk = (duskduration/86400).toFixed(3);

/*
	Functions!
 */
/**
 * iniates animations
 */
function init()
{
	(function(){
		if(!Array.prototype.indexOf)
			Array.prototype.indexOf = function(obj){for(var i=0;i<this.length;i++){if(this[i]===obj){return i;}}return -1;};
		var isAgent = function(agent){return navigator.userAgent.indexOf(agent) >= 0 ? true:false;};
		if(!(isAgent('Mobile') || isAgent('Android'))){
			addClouds();
			animateClouds();
			initsun();
		}
		// set colors at load and init continuous color change
		initcolor();
	})(this);
}

/**
 * initiate background color rendering
 */
function initcolor()
{
	setcolor();
	setInterval(setcolor, bgupdateinterval);
}
/**
 * initiate sun rendering
 */
function initsun()
{
	var thesun = document.createElement("div");
	thesun.id = "thesun";
	bg.appendChild(thesun);

	animatesun();
	setInterval(animatesun, bgupdateinterval);
}

/**
 * Please close you eyes, it's about to get ugly.
 * http://imgur.com/HSrG9rs
 */
function setcolor()
{
	var to = [], from = [],
		newdark = [], newlight = [],
		progress, diff = 0,
		current = rightnow()/86400;

	// DAY -> SUNSET!
	if (current > setstart && current <= set)
	{
		console.log("day->sunset");
		diff = setstart;
		to = [sunsetdark, sunsetlight],
		from = [daydark, daylight];
	}
	// SUNSET -> NIGHT
	else if (current > set && current < setend)
	{
		display("thesun", "none");
		console.log("sunset->night");
		diff = set;
		to = [nightdark, nightlight],
		from = [sunsetdark, sunsetlight];
	}
	// NIGHT -> SUNRISE
	else if (current > risestart && current <= rise)
	{
		display("thesun", "none");
		console.log("night->sunrise");
		diff = risestart;
		to = [sunsetdark, sunsetlight],
		from = [nightdark, nightlight];
	}
	// SUNRISE -> DAY
	else if (current > rise && current < riseend)
	{
		display("thesun", "block");
		console.log("sunrise->day");
		diff = rise;
		to = [daydark, daylight],
		from = [sunsetdark, sunsetlight];
	}
	// DAY!
	else if(current > rise && current < set)
	{
		console.log("DAY");
		lingrad(daydark, daylight, bg);
		// end function here!
		return false;
	}
	// night!
	else
	{
		display("thesun", "none");
		sun = [50, 50];
		console.log("NIGHT");
		lingrad(nightdark, nightlight, bg);
		// end function
		return false;
	}
	// calculate progress
	progress = (current-diff)/dusk;
	for (var i = 0; i < 3; i++) {
		newdark[i] = Math.floor(from[0][i]+progress*(to[0][i]-from[0][i]));
		newlight[i] = Math.floor(from[1][i]+progress*(to[1][i]-from[1][i]));
	};
	lingrad(newdark, newlight, bg);
}

function animatesun()
{
	// update the suns position
	sunposition(dayprogress());
	var thesun = document.getElementById("thesun");
	var r = rightnow()/10;

	thesun.style.left = sun[0]+'%';
	thesun.style.top = sun[1]+'%';
	thesun.style[cssprefix+'transform'] = "rotate(" + r + "deg)";
}

/**
 * determines where the sun should be based on the day's progress
 * @param  {float} progress how far we've come into the day
 * @return {void}           changes the sun array
 */
function sunposition(progress)
{
	if(progress > 1) progress = 1;
	if(progress < 0) progress = 0;

	// suns position on the x-axis, in percent.
	// it rises in the east, sets in the west
	sun[0] = 100 - (100 * progress); // x-axis
	sun[1] = 50 - Math.abs(progress-Math.pow(progress,2))*160; // y-axis

	console.log("Suns position: ("+sun[0]+","+sun[1]+")");
}
/**
 * requestAnimationFrame polyfill by Erik Mller
 * fixes from Paul Irish and Tino Zijdel
 *
 * http://paulirish.com/2011/requestanimationframe-for-smart-animating/
 * http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
 */
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
    // kolla om klient stödjer transformproperty
    if(!cssprefix)
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
            cloud.style[cssprefix+'transform'] = "translateX(" + xspeed[i] * x + "px) scale(" + s + ")";
        }

        requestAnimationFrame(animate);
    };

    animate();

}
/**
 * get the css prefix for the current client
 * @param  {string} 		name the name of the css property you want to use
 * @return {string,bool}	prefix if it exists, false if not
 */
function getCssPrefix(name)
{
	var prefixes = ['', '-webkit-', '-moz-', '-ms-', '-o-'],
		el = document.createElement('div'),
		index = 0;

	while (index < prefixes.length) {
		var prefix = prefixes[index++];
		if (document.createElement('div').style[prefix + name] !== undefined) {
			return prefix;
		}
	}

	return false;
}

function lingrad(dark, light, theobject)
{
	theobject.style.backgroundImage = cssprefix + "radial-gradient("+sun[0]+"% "+sun[1]+"%, circle cover, rgb("+light[0]+","+light[1]+", "+light[2]+") 0%, rgb("+dark[0]+","+dark[1]+", "+dark[2]+") 100%)";
	console.log("Redrawing: " + dark + " & " + light);
}

function display(objectid, status)
{
	theobj = document.getElementById(objectid);
	if(theobj)
		theobj.style.display = status;
}
