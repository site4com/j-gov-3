var frControls = new Class({ 
	Implements: [Options, Events],
	options: {
		prefs_loaded: false,
		default_font: 76,
		fs_current: null,
		skin_current: null,  
		skin_contrast: 'blackred',
		contrast_enabled: 2,
		maxfont: 150,
		minfont: 50,
		decrease_key: 'D',
		increase_key: 'I',
		contrast_key: 'C',
		reset_key: 'R'
	},
	 
	initialize: function(options){ 
		this.setOptions(options);
		if(!this.options.prefs_loaded){ 
			var c = Cookie.read('joomla_fs');
			this.options.fs_current = c ? c : this.options.default_font;
	        if(this.options.fs_current)
	        	this.fs_set();
	
	        var s = Cookie.read('joomla_skin');
	        this.options.skin_current = s ? s : null;
	        if(this.options.skin_current)
	        	this.skin_set();
	        // Loaded
	        this.options.prefs_loaded = true;
	    }
		// Inject controls
		this.injectElements();
		
		// Register events
		$('fr_increase').addEvent('click',this.fs_change.bind(this, 1));
		$('fr_decrease').addEvent('click',this.fs_change.bind(this, -1)); 
		if($('fr_contrast')) {
			$('fr_contrast').addEvent('click',this.skin_change.bind(this, -1));  
		}
		$('fr_reset').addEvent('click',this.reset.bind(this, -1)); 
	},
	
	fs_change: function (diff){
		// Security safe
		var parsed_fs_current = parseInt(this.options.fs_current);
		if(isNaN(parsed_fs_current)) {
			this.options.fs_current = this.options.default_font; 
		}
		this.options.fs_current = parseInt(this.options.fs_current) + parseInt(diff * 5);

	    if(this.options.fs_current > this.options.maxfont){
	    	this.options.fs_current = this.options.maxfont;
	    }else if(this.options.fs_current < this.options.minfont){
	    	this.options.fs_current = this.options.minfont;
	    }
	    // Refresh setting
	    this.fs_set();
	},

	skin_change: function (skin){ 
		if (this.options.skin_current == this.options.skin_contrast){
                skin = null;
        } else {
                skin = this.options.skin_contrast;
        }
	 
		this.options.skin_current = skin;
		if(!!(this.options.skin_current)) {
			this.skin_set();  
		} else {
			// Reset
			document.getElement('body').removeClass(this.options.skin_contrast);
			Cookie.write('joomla_skin', false, {path: '/', duration: -365}); 
		}
	},

	fs_set: function (){ 
		if(!!(this.options.fs_current)) { 
			document.getElement('body').setStyle('font-size', this.options.fs_current + '%');  
			Cookie.write('joomla_fs', this.options.fs_current, {path: '/', duration: 365});
		} 
	},

	skin_set: function (){
		if(!!(this.options.skin_current)) { 
			document.getElement('body').addClass(this.options.skin_current);
			Cookie.write('joomla_skin', this.options.skin_current, {path: '/', duration: 365}); 
		}
	},
	
	reset: function (){ 
		document.getElement('body').setStyle('font-size', this.options.default_font + '%');  
		Cookie.write('joomla_fs', false, {path: '/', duration: -365});
		document.getElement('body').removeClass(this.options.skin_current);
		Cookie.write('joomla_skin', false, {path: '/', duration: -365}); 
		// Reset
		this.options.skin_current = null;
		this.options.fs_current = this.options.default_font;
	},
	
	injectElements: function() { 
		// Inject del container
		var controlsContainer = new Element('div', {
		    'id': 'accessibility-links'
		}); 
		controlsContainer.inject(document.getElement('body'), 'top');
		
		// Inject del decrease
		var decreaseButton = new Element('input', { 
		    'id': 'fr_decrease',
		    'type':'button',
		    'value':' ',
		    'accesskey': this.options.decrease_key,
		    'title': fr_decrease_title
		});
		controlsContainer.adopt(decreaseButton);
		 
		// Inject del increase
		var increaseButton = new Element('input', { 
		    'id': 'fr_increase',
		    'type':'button',
		    'value':' ',
		    'accesskey': this.options.increase_key,
		    'title': fr_increase_title
		});
		controlsContainer.adopt(increaseButton);

		// Label
		var labelFirst = new Element('label', { 
			'class': 'fr_label',
			'for': 'fr_decrease'
		}).appendText(fr_labelFirst);
		
		controlsContainer.adopt(labelFirst);
		
		
		if(this.options.contrast_enabled == 2) {
			
			// Inject del contrasto
			var contrastButton = new Element('input', { 
				'id': 'fr_contrast',
				'type':'button',
				'value':' ',
				'accesskey': this.options.contrast_key,
				'title': fr_contrasto_title
			});
			controlsContainer.adopt(contrastButton); 
			// Label
			var labelContrast = new Element('label', { 
				'class': 'fr_label',
				'for': 'fr_contrast'
			}).appendText(fr_contrast);
			controlsContainer.adopt(labelContrast);
			
		}
		
		
		// Inject del reset
		var increaseButton = new Element('input', { 
		    'id': 'fr_reset',
		    'type':'button',
		    'value':' ',
		    'accesskey': this.options.reset_key,
		    'title': 'Reset'
		});
		controlsContainer.adopt(increaseButton);

		// Label
		var labelReset = new Element('label', { 
			'class': 'fr_label',
			'for': 'fr_reset'
		}).appendText(fr_reset);
		controlsContainer.adopt(labelReset);
		
	} 
});