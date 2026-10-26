
(function(){
	'use strict';
	var root=document.documentElement;
	var toggle=document.getElementById('better_dark_mode_toggle');

	function resolved(choice){
		if(choice==='system')
			return window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light';
		return choice==='dark'?'dark':'light';
	}

	function choice(){
		return localStorage.getItem('betterDarkMode')||root.getAttribute('data-better-dark-mode-choice')||'system';
	}

	function apply(c,remember){
		var mode=resolved(c);
		root.setAttribute('data-better-dark-mode',mode);
		root.setAttribute('data-better-dark-mode-choice',c);
		if(remember)localStorage.setItem('betterDarkMode',c);
		if(toggle){
			toggle.setAttribute('aria-pressed',mode==='dark'?'true':'false');
			toggle.setAttribute('data-mode',mode);
			toggle.setAttribute('title',mode==='dark'?'Switch to light mode':'Switch to dark mode');
			toggle.setAttribute('aria-label',mode==='dark'?'Switch to light mode':'Switch to dark mode');
		}
	}

	if(toggle){
		toggle.addEventListener('click',function(){
			apply(root.getAttribute('data-better-dark-mode')==='dark'?'light':'dark',true);
		});
	}

	if(window.matchMedia){
		var media=window.matchMedia('(prefers-color-scheme: dark)');
		if(media.addEventListener){
			media.addEventListener('change',function(){
				if(choice()==='system')apply('system',false);
			});
		}
	}

	apply(choice(),false);
})();
