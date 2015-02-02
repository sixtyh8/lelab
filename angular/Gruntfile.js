'use strict';

module.exports = function (grunt) {

	// Load Grunt Tasks
	require('load-grunt-tasks')(grunt);
	require('time-grunt')(grunt);
	grunt.loadNpmTasks('grunt-shell');
    grunt.loadNpmTasks('grunt-wiredep');
	grunt.loadNpmTasks('grunt-text-replace');

	// Grunt Config
	grunt.initConfig({

		/**
		 * Configuration Object
		 * @type {Object}
		 */
		config: {
			// Paths
			app: require('./bower.json').appPath || 'app',
			dist: 'dist',
			www: 'www',
			hostname: 'ng.lelab.local',
			port: 80,
			logfile: 'log/server.log',
			server: 'server.js'
		},

		// Connect server - used for tests
		connect: {
			test: {
				options: {
					port: 9001,
					base: [
					'.tmp',
					'test',
					'<%= config.app %>'
					]
				}
			},
			dist: {
				options: {
					base: '<%= config.dist %>'
				}
			}
		},

		replace: {
		  prod: {
		    src: ['app/scripts/config/config.coffee'],
		    overwrite: true,
		    replacements: [{
		      from: "ENV: 'DEV'",
		      to: "ENV: 'PROD'"
		    },
			{
				from: "http://api.lelab.local/",
				to: "http://api.lelabmastering.com/"
			}]
		  },
		  dev: {
			src: ['app/scripts/config/config.coffee'],
			overwrite: true,
			replacements: [{
				from: "ENV: 'PROD'",
				to: "ENV: 'DEV'"
			},
			{
				from: "http://api.lelabmastering.com/",
				to: "http://api.lelab.local/"
			}]
		  }
	    },

		// Running concurrent tasks
		concurrent: {
			dev: {
				tasks: ['watch'],
				options: {
					logConcurrentOutput: true
				}
			},
			test: [
			  'compass',
			  'coffee',
			  'copy:styles'
			],
			dist: [
				'coffee:dist',
		        'compass:dist',
		        'copy:styles',
		        'htmlmin'
		    ]
		},

		// Nodemon to run the node server
		nodemon: {
			dev: {
				script: '<%= config.server %>',
		      	// omit this property if you aren't serving HTML files and
		      	// don't want to open a browser tab on start
			    callback: function (nodemon) {
			      	nodemon.on('log', function (event) {
			      		console.log(event.colour);
			    	});

			        // opens browser on initial server start
			        nodemon.on('config:update', function () {
				          // Delay before server listens on port
				          setTimeout(function() {
				          	require('open')('http://<%= config.hostname %>:<%= config.port %>');
				          }, 1000);
			      	});

			        // refreshes browser when server reboots
			        nodemon.on('restart', function () {
				        // Delay before server listens on port
				    	setTimeout(function() {
				          	require('fs').writeFileSync('.rebooted', 'rebooted');
				        }, 1000);
			      	});
		    	}
			}
		},

		// Open the browser to the path provided
		open: {
			server: {
				path: 'http://<%= config.hostname %>:<%= config.port %>'
			}
		},

		// Watches files for changes and runs tasks based on the changed files
		watch: {
			coffee: {
				files: ['<%= config.app %>/scripts/{,*/}*.{coffee,litcoffee,coffee.md}'],
				tasks: ['newer:coffee:dist']
			},
			coffeeTest: {
				files: ['test/spec/{,*/}*.{coffee,litcoffee,coffee.md}'],
				tasks: ['coffee:test', 'karma']
			},
			js: {
				files: ['<%= config.app %>/scripts/{,*/}*.js'],
				tasks: ['jshint:all'],
				options: {
					livereload: true
				}
			},
			html: {
    			files: ['<%= config.app %>/index.html', '<%= config.app %>/views/**/*'],
    			tasks: ['copy:html']
			},
			jsTest: {
				files: ['test/spec/{,*/}*.js'],
				tasks: ['jshint:test', 'karma']
			},
			compass: {
				files: ['<%= config.app %>/styles/{,*/}*.{scss,sass}'],
				tasks: ['compass', 'autoprefixer']
			},
			gruntfile: {
				files: ['Gruntfile.js']
			},
			server: {
				files: ['.rebooted'],
				options: {
					livereload: true
				}
			}
		},

		// Compiles CoffeeScript to JavaScript
		coffee: {
			options: {
				sourceMap: true,
				sourceRoot: ''
			},
			dist: {
				files: [{
					expand: true,
					cwd: '<%= config.app %>/scripts',
					src: '{,*/}*.coffee',
					dest: '<%= config.www %>/scripts',
					ext: '.js'
				}]
			},
			test: {
				files: [{
					expand: true,
					cwd: 'test/spec',
					src: '{,*/}*.coffee',
					dest: '.tmp/spec',
					ext: '.js'
				}]
			},
			dev: {
				files: [{
					expand: true,
					cwd: '<%= config.app %>/scripts',
					src: '{,*/}*.coffee',
					dest: '<%= config.www %>/scripts',
					ext: '.js'
				}]
			}
		},

		// Automatically inject Bower components into the app
		'bower-install': {
			app: {
				html: '<%= config.app %>/index.html',
				ignorePath: '<%= config.app %>/'
			}
		},

        wiredep: {

          target: {

            // Point to the files that should be updated when
            // you run `grunt wiredep`
            src: [
              'app/index.html'
            ],

            // Optional:
            // ---------
            cwd: '',
            dependencies: true,
            devDependencies: false,
            exclude: [],
            fileTypes: {},
            ignorePath: '',
            overrides: {}
          }
        },

		// Clean Directories
		clean: {
			dist: {
				files: [{
					dot: true,
					src: [
						'.tmp',
						'<%= config.dist %>/*',
						'!<%= config.dist %>/.git*'
					]
				}]
			},
			server: '.tmp',
			dev: '<%= config.www %>/*'
		},

		// Copy Files
		copy: {
			dist: {
				files: [{
					expand: true,
					dot: true,
					cwd: '<%= config.app %>',
					dest: '<%= config.dist %>',
					src: [
						'*.{ico,png,txt}',
						'.htaccess',
						'i18n/*',
						'bower_components/**/*',
						'images/{,*/}*.{gif,webp,png,jpg,jpeg}',
						'fonts/*'
					]
				},{
					expand: true,
					cwd: '.tmp/images',
					dest: '<%= config.dist %>/images',
					src: [
						'generated/*'
					]
				}]
			},
			dev: {
				files: [{
					expand: true,
					dot: true,
					cwd: '<%= config.app %>',
					dest: '<%= config.www %>',
					src: [
						'*.{ico,png,txt}',
						'.htaccess',
						'i18n/*',
						'bower_components/**/*',
						'images/{,*/}*.{gif,webp,png,jpg,jpeg}',
						'fonts/*',
						'views/**/*',
						'index.html'
					]
				},{
					expand: true,
					cwd: '.tmp/images',
					dest: '<%= config.www %>/images',
					src: [
						'generated/*'
					]
				}]
			},
			html: {
    			files: [{
					expand: true,
					dot: true,
					cwd: '<%= config.app %>',
					dest: '<%= config.www %>',
					src: [
						'views/**/*',
						'index.html'
					]
				}]
			},
			devstyles: {
				expand: true,
				cwd: '<%= config.app %>/styles',
				dest: '<%= config.www %>/styles/',
				src: '{,*/}*.css'
			},
			styles: {
				expand: true,
				cwd: '<%= config.app %>/styles',
				dest: '.tmp/styles/',
				src: '{,*/}*.css'
			}
		},

		// HTML minification
		htmlmin: {
			dist: {
				files: [{
					expand: true,
					cwd: '<%= config.app %>',
					src: ['*.html', 'views/{,*/}*.html'],
					dest: '<%= config.dist %>'
				}]
			},
			dev: {
				files: [{
					expand: true,
					cwd: '<%= config.app %>',
					src: ['*.html', 'views/{,*/}*.html'],
					dest: '<%= config.www %>'
				}]
			}
		},

		// Testing with karma
		karma: {
			unit: {
				configFile: 'karma.conf.js',
				singleRun: true
			}
		},

		// Minify AngulaJS app
		ngmin: {
			dist: {
				files: [{
					expand: true,
					cwd: '.tmp/concat/scripts',
					src: '*.js',
					dest: '.tmp/concat/scripts'
				}]
			}
		},

		// Minify and Concat scripts
		uglify: {
			dist: {
				files: {
					'<%= config.dist %>/scripts/scripts.js': [
					'<%= config.dist %>/scripts/scripts.js'
					]
				}
			}
		},

		// HTML and CSS Minification and Copy
		useminPrepare: {
			html: '<%= config.app %>/index.html',
			options: {
				dest: '<%= config.dist %>'
			}
		},
		usemin: {
			html: ['<%= config.dist %>/{,*/}*.html'],
			css: ['<%= config.dist %>/styles/{,*/}*.css'],
			options: {
				dirs: ['<%= config.dist %>']
			}
		},

		// JS Hinting
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'<%= config.app %>/scripts/{,*/}*.js'
			]
		},

		// Adding Vendor Prefixes to CSS
		autoprefixer: {
			options: ['last 1 version'],
			dist: {
				files: [{
					expand: true,
					cwd: '.tmp/styles/',
					src: '{,*/}*.css',
					dest: '.tmp/styles/'
				}]
			}
		},

		// Compiles Sass to CSS and generates necessary files if requested
		// To replace with sass watch for performance gain
		compass: {
			options: {
				sassDir: '<%= config.app %>/styles',
				cssDir: '<%= config.www %>/styles',
				generatedImagesDir: '<%= config.www %>/images/generated',
				imagesDir: '<%= config.app %>/images',
				javascriptsDir: '<%= config.app %>/scripts',
				fontsDir: '<%= config.app %>/styles/fonts',
				importPath: '<%= config.app %>/bower_components',
				httpImagesPath: '/images',
				httpGeneratedImagesPath: '/images/generated',
				httpFontsPath: '/styles/fonts',
				relativeAssets: false,
				assetCacheBuster: false,
				raw: 'Sass::Script::Number.precision = 10\n'
			},
			dist: {
				options: {
					generatedImagesDir: '<%= config.dist %>/images/generated'
				}
			},
			server: {
				options: {
					debugInfo: true
				}
			},
			dev: {
    			options: {
        			debugInfo: true
    			}
			}
		}

	});

	// Server Task
	// usage: 'grunt server'
	grunt.registerTask('serve', function (target) {
		if (target === 'dist') {
			return grunt.task.run(['build', 'open', 'connect:dist:keepalive']);
		}

		grunt.task.run([
			'clean:server',
			'compass:server',
			'coffee:dist',
			'concurrent:dev'
		]);
	});

	// Test Task
	// usage: 'grunt test'
	grunt.registerTask('test', [
		'clean:server',
	    'concurrent:test',
	    'autoprefixer',
	    'connect:test',
	    'karma'
	]);

	// Build Task
	// usage: 'grunt build'
	grunt.registerTask('build', [
		'clean:dist',
		'replace:prod',
	    'useminPrepare',
	    'concurrent:dist',
	    'autoprefixer',
	    'concat',
	    'copy:dist',
	    'ngmin',
	    'cssmin',
	    'uglify',
	    'usemin',
		'replace:dev'
	]);

	grunt.registerTask('dev', [
	    'clean:dev',
	    'compass:dev',
	    'copy:dev',
	    'copy:devstyles',
	    'coffee:dist',
        'concurrent:dev'
	]);

    grunt.registerTask('install', [
        'bower-install'
    ]);

	// Default Task
	// usage: 'grunt'
	grunt.registerTask('default', [
		'jshint',
		//'test',
		'build'
	]);
};
