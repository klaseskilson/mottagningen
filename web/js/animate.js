/**
 * requestAnimationFrame polyfill by Erik MÃ¶ller
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
		if(!Array.prototype.indexOf) Array.prototype.indexOf = function(obj){for(var i=0;i<this.length;i++){if(this[i]===obj){return i;}}return -1;}
		var isAgent = function(agent){return navigator.userAgent.indexOf(agent) >= 0 ? true:false;}
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
		if (document.createElement('div').style[prefix] != undefined) {
			return prefix;
		}
	}

	return false;
};

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
		cloud.style.left = parseInt(Math.random() * 1600)+'px';
		cloud.style.bottom = parseInt(Math.random() * 700)+'px';

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

	console.log(transformProperty);
}
