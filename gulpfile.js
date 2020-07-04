"use strict";

var gulp = require("gulp");
var plumber = require("gulp-plumber");
var rename = require("gulp-rename");
var less = require("gulp-less");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var csso = require("gulp-csso");
var imagemin = require("gulp-imagemin");
var concat = require("gulp-concat");
// var webp = require("gulp-webp");
// var svgstore = require("gulp-svgstore");
var del = require("del");
var server = require("browser-sync").create();

gulp.task("css", function () {
  return gulp.src("source/less/style.less")
    .pipe(plumber())
    .pipe(less())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(csso())
    .pipe(rename("style.min.css"))
    .pipe(gulp.dest("Intogate/css"))
    .pipe(gulp.dest("../Intogate/css"))
    .pipe(server.stream());
});

// сборка css файлов
gulp.task("style", function () {
  return gulp.src("source/css/**/*.css")
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(csso())
    .pipe(gulp.dest("Intogate/css"))
    .pipe(gulp.dest("../Intogate/css"))
    .pipe(server.stream());
});

gulp.task("images", function () {
  return gulp.src("source/img/**/*.{png,jpg,svg}")
  .pipe(imagemin([
    // imagemin.optipng({optimizationLevel: 3}),
    imagemin.jpegtran({progressive: true}),
    imagemin.svgo()
  ]))
  .pipe(gulp.dest("source/img"))
  .pipe(gulp.dest("../source/img"));
});

gulp.task("page.php", function () {
  return gulp.src("source/*.php")
  .pipe(gulp.dest("Intogate"))
  .pipe(gulp.dest("../Intogate"));
});

gulp.task("scripts", function() {
  return gulp.src("source/js/*.js") // директория откуда брать исходники
      .pipe(concat("scripts.js")) // объеденим все js-файлы в один
      // .pipe(uglify()) // вызов плагина uglify - сжатие кода
      .pipe(rename({ suffix: '.min' })) // вызов плагина rename - переименование файла с приставкой .min
      .pipe(gulp.dest("Intogate/js"))
      .pipe(gulp.dest("../Intogate/js")); // директория продакшена, т.е. куда сложить готовый файл
});
gulp.task("js:build", function() {
return gulp.src("source/js/js-inner/*.js") // директория откуда брать исходники
      // .pipe(uglify()) // вызов плагина uglify - сжатие кода
      .pipe(gulp.dest("Intogate/js"))
      .pipe(gulp.dest("../Intogate/js"));
});

gulp.task("copy", function () {
  return gulp.src([
  "source/fonts/**/*.{woff,woff2}",
  "source/img/**",
  "source/favicon/**",
  "source/*.ico"
  ], {
  base: "source"
  })
  .pipe(gulp.dest("Intogate"))
  .pipe(gulp.dest("../Intogate"));
 });

 gulp.task("clean", function () {
  return del("Intogate");
  return del("../Intogate");
 });

 gulp.task("core", function() {
   return gulp.src("core/**/*.php")
    .pipe(gulp.dest("Intogate/core"))
    .pipe(gulp.dest("../Intogate/core"));
  });

  gulp.task("server", function () {
  server.init({
    server: "Intogate/",
    notify: false,
    open: true,
    cors: true,
    ui: false
  });

  gulp.watch("source/less/**/*.less", gulp.series("css"));
  gulp.watch("source/css/**/*.css", gulp.series("style"));
  gulp.watch("source/js/*.js", gulp.series("scripts"));
  gulp.watch("source/js/js-inner/*.js", gulp.series("js:build"));
  gulp.watch("source/*.php", gulp.series("page.php", "refresh"));
  gulp.watch("core/**/*.php", gulp.series("core", "refresh"));
});

gulp.task("refresh", function (done) {
  server.reload();
  done();
  });

gulp.task("start", gulp.series("css", "server"));

gulp.task("build", gulp.series(
  "clean",
  "copy",
  "css",
  "style",
  "scripts",
  "js:build",
  "page.php",
  "core"
  ));
