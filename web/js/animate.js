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

function init()
{
	(function(){
		if(!Array.prototype.indexOf)
			Array.prototype.indexOf = function(obj){for(var i=0;i<this.length;i++){if(this[i]===obj){return i;}}return -1;};
		var isAgent = function(agent){return navigator.userAgent.indexOf(agent) >= 0 ? true:false;};
		if(!(isAgent('Mobile') || isAgent('Android'))){
			addClouds();
			animateClouds();
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
		cloud.src = "../web/img/Moln.png";
		cloud.className = "cloud";
		cloud.id = "cloud" + i;
		cloud.style.left = parseInt(Math.random() * 800)+'px';
		cloud.style.top = parseInt(Math.random() * 300)+'px';

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
	cloudsDiv.className += "animated";

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

	var animate = function(){
		for(var i = 0; i < clouds.length; i++)
		{
			var cloud = clouds[i];
			var rDuration = rDirections[i];
			var r = ((Date.now() / rDuration) % 1) * 360 * rDirections[i];
			var t = (Date.now() / tDuration + tOffsets[i]) % 1;
			var x = 2000 * t;
			var y = 120 + Math.pow(t - 0.5, 2) * 1000 + yOffsets[i];
			var s = Math.min(Math.min(t / 0.1, (1 - t) / 0.1), 1);

			// translateY(" + y + "px) scale(" + s + ")
			cloud.style[transformProperty] = "translateX(" + x + "px)";
		}

		requestAnimationFrame(animate);
	};

	animate();

}
