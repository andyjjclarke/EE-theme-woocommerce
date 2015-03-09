module.exports = function(grunt) {
    grunt.initConfig({
        path: ".",
        sass: {
            dist: {
                options: {
                    style: 'expanded'
                            // loadPath: require('node-bourbon').includePaths
                },
                files: {
                    '<%= path %>/css/theme.css': '<%= path %>/css/sass/theme.scss'
                }
            }
        },
        watch: {
            php: {
                files: '<%= path %>/**/*.php',
                tasks: [],
                options: {
                    livereload: true,
                }
            },
            scss: {
                files: '<%= path %>/css/sass/**/*.scss',
                tasks: ['sass'],
            },
            js: {
                files: '<%= path %>/js/general.js',
                tasks: [],
                options: {
                    livereload: true,
                }
            },
            css: {
                files: '<%= path %>/css/theme.css',
                tasks: [],
                options: {
                    livereload: true,
                },
            },
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('default', ['watch']);

};