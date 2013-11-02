/*!
 * Cribbb Gruntfile
 * http://cribbb.com
 * @author Philip Brown
 */

'use strict';

/**
 * Grunt Module
 */
module.exports = function(grunt) {

  /**
   * Configuration
   */
  grunt.initConfig({

    /**
     * Get package meta data
     */
    pkg: grunt.file.readJSON('package.json'),

    /**
     * Set project object
     */
    project: {
      app: 'app',
      assets: '<%= project.app %>/assets',
      css: [
        '<%= project.assets %>/scss/style.scss'
      ],
      js: [
        'public/js/*.js'
      ]
    },

    /**
     * Project banner
     */
    tag: {
      banner: '/*!\n' +
              ' * <%= pkg.name %>\n' +
              ' * <%= pkg.title %>\n' +
              ' * <%= pkg.url %>\n' +
              ' * @author <%= pkg.author %>\n' +
              ' * @version <%= pkg.version %>\n' +
              ' * Copyright <%= pkg.copyright %>. <%= pkg.license %> licensed.\n' +
              ' */\n'
    },

    /**
     * Sass
     */
    sass: {
      dev: {
        options: {
          style: 'expanded',
          banner: '<%= tag.banner %>',
          compass: true
        },
        files: {
          'public/css/style.css': '<%= project.css %>'
        }
      },
      dist: {
        options: {
          style: 'compressed',
          compass: true
        },
        files: {
          'public/css/style.css': '<%= project.css %>'
        }
      }
    },

    /**
     * CSSMin
     * CSS minification
     * https://github.com/gruntjs/grunt-contrib-cssmin
     */
    cssmin: {
      dev: {
        options: {
          banner: '<%= tag.banner %>'
        },
        files: {
          'public/css/style.min.css': [
            '<%= project.assets %>/bower/normalize-css/normalize.css',
            'public/css/style.css'
          ]
        }
      },
      dist: {
        options: {
          banner: '<%= tag.banner %>'
        },
        files: {
          'public/css/style.min.css': [
            '<%= project.assets %>/bower/normalize-css/normalize.css',
            'public/css/style.css'
          ]
        }
      }
    },

    /**
     * Watch
     */
    watch: {
      sass: {
        files: '<%= project.assets %>/scss/{,*/}*.{scss,sass}',
        tasks: ['sass:dev', 'cssmin:dev']
      }
    }

  });

  /**
   * Load Grunt plugins
   */
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  /**
   * Default task
   * Run `grunt` on the command line
   */
  grunt.registerTask('default', [
    'sass:dev',
    'cssmin:dev',
    'watch'
  ]);

  /**
   * Build task
   * Run `grunt build` on the command line
   * Then compress all JS/CSS files
   */
  grunt.registerTask('build', [
    'sass:dist'
  ]);

};
