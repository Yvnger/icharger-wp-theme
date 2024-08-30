// Config vars
const DEST = "assets";
const isDev = process.env.NODE_ENV === "development";
const isProd = process.env.NODE_ENV === "production";
import gulp from "gulp";
// Utils
import cache from "gulp-cache";
import {deleteAsync, deleteSync} from "del";
import rename from "gulp-rename";
import sourcemaps from "gulp-sourcemaps";
import connect from "gulp-connect";
import gulpif from "gulp-if";
// Images
import imagemin, {mozjpeg, optipng, svgo} from "gulp-imagemin";
import webp from "gulp-webp";
import favicons from "gulp-favicons";
import svgstore from "gulp-svgstore";
// Fonts
import ttf2woff from "gulp-ttf2woff";
import ttf2woff2 from "gulp-ttf2woff2";
// HTML Layout
import handlebars from "gulp-compile-handlebars";
// import htmlMin from 'gulp-htmlmin';
// import htmlReplace from 'gulp-html-replace';
import typograf from "gulp-typograf";
// Styles
import * as sassModule from "sass";
import gulpSass from "gulp-sass";
import autoprefixer from "gulp-autoprefixer";
import cssNano from "gulp-cssnano";
import groupMedia from "gulp-group-css-media-queries";
import cleanCss from "gulp-clean-css";
import pxToRem from "gulp-px2rem-converter";
// Scripts
import babel from "gulp-babel";
import browserify from "browserify";
import babelify from "babelify";
import source from "vinyl-source-stream";
import buffer from "vinyl-buffer";
import terser from "gulp-terser"; // ES6
// import uglify from 'gulp-uglify'; // ES5
const sass = gulpSass(sassModule);

// Clear cache
gulp.task("clean-cache", (done) => {
  cache
    .clearAll()
    .then(() => {
      console.log("Кэш очищен.");
      done();
    })
    .catch((error) => {
      console.error(`Ошибка при очистке кэша: ${error}`);
      done(error);
    });
});

// Clear destination directory
gulp.task("clean-dest", async () => {
  deleteSync(DEST);
});

// Clear cache & destination folder
gulp.task("clear", gulp.series("clean-cache", "clean-dest"));

gulp.task("connect", () => {
  connect.server({
    root: DEST,
    livereload: true,
    host: "127.0.0.1"
  });
});

// Images optimization
gulp.task("images", () => {
  return gulp
    .src("src/assets/images/**/*.{png,jpg,jpeg}")
    .pipe(
      cache(
        imagemin([
          mozjpeg({
            quality: 85, // Качество сжатия (0-100)
            progressive: true, // Прогрессивное JPEG
            targa: false, // Формат TARGA
            revert: false, // Отменить оптимизацию для определенных изображений
            fastCrush: false, // Быстрое сжатие (меньше оптимизации)
            dcScanOpt: 1, // Оптимизация сканирования DC (0-2)
            trellis: true, // Оптимизация Trellis
            trellisDC: true, // Trellis оптимизация для DC коэффициентов
            tune: "hvs-psnr", // Настройка метрики (например, 'psnr', 'hvs-psnr', 'ssim')
            overshoot: true, // Оптимизация для смещения цвета
            arithmetic: false, // Арифметическое кодирование
            dct: "int", // Тип DCT ('int' или 'float')
            quantBaseline: false, // Базовое квантование
          }),
          optipng({
            optimizationLevel: 3, // Уровень оптимизации (0-7)
            bitDepthReduction: true, // Сокращение битовой глубины, если это возможно
            colorTypeReduction: true, // Сокращение типа цвета, если это возможно
            paletteReduction: true, // Сокращение палитры, если это возможно
          }),
        ]),
      ),
      {
        name: "images-cache", // Уникальное имя кеша
        cacheDir: "cache/images", // Директория для хранения кеша на диске
      },
    )
    .pipe(gulp.dest(`${DEST}/images`))
    .pipe(gulp.src("src/assets/images/**/*.{png,jpg,jpeg}"))
    .pipe(webp({quality: 85}))
    .pipe(gulp.dest(`${DEST}/images`))
    .pipe(connect.reload());
});

// Fonts
gulp.task("fonts", () => {
  return gulp
    .src("src/assets/fonts/**/*.ttf")
    .pipe(ttf2woff())
    .pipe(gulp.dest(`${DEST}/assets/fonts`))
    .pipe(gulp.src("src/assets/fonts/**/*.ttf"))
    .pipe(ttf2woff2())
    .pipe(gulp.dest(`${DEST}/assets/fonts`));
})

// Sprites
gulp.task("sprites", () => {
  return gulp
    .src("src/assets/images/svg/**/*.svg")
    // .pipe(imagemin([svgo({
      // plugins: [
        // {name: "removeViewBox", active: true},
        // {name: "cleanupIDs", active: true}
      // ]
    // })]))
    // .pipe(svgstore({inlineSvg: true}))
    // .pipe(rename("sprites.svg"))
    .pipe(gulp.dest(`${DEST}/images/svg`));
});

// Favicon: generate
gulp.task("favicon-generate", (done) => {
  return gulp
    .src("src/images/favicon.ico", {allowEmpty: true})
    .pipe(
      favicons({
        appName: "iCharge", // Название вашего приложения
        appShortName: "iCharger", // Короткое название приложения
        appDescription: "Зарядные станции для электромобилей", // Описание приложения
        developerName: "Kwaina", // Имя разработчика
        background: "#ffffff", // Фоновый цвет для Windows Tile
        path: "favicons/", // Путь, где будут храниться сгенерированные фавиконки
        url: "https://i-charger.ru/", // URL вашего сайта
        display: "standalone",
        orientation: "portrait",
        scope: "/",
        start_url: "/?homescreen=1",
        version: 1.0,
        html: "index.html",
        pipeHTML: true,
        replace: true,
      }),
    )
    .pipe(gulp.dest(`${DEST}/favicons`))
    .on("end", done);
});

// Favicon: move .ico to root
gulp.task("favicon-ico-to-root", async () => {
  const source = `${DEST}/favicons/favicon.ico`;

  // Копирование favicon.ico в корневую директорию
  await new Promise((resolve, reject) => {
    gulp
      .src(source, {allowEmpty: true})
      .pipe(gulp.dest(DEST))
      .pipe(connect.reload())
      .on("end", resolve)
      .on("error", reject);
  });

  // Удаление исходного favicon.ico
  await deleteAsync(source);
});

// Favicon: create multi-task
gulp.task("favicon", gulp.series("favicon-generate", "favicon-ico-to-root"));

// HTML Layout
gulp.task("html", () => {
  const options = {
    batch: ["./src/templates/partials"],
    helpers: {},
  };

  return (
    gulp
      .src(["src/templates/**/*.hbs", "!src/templates/partials/**/*"])
      .pipe(handlebars({}, options).on("error", console.error))
      .pipe(
        rename({
          extname: ".html",
        }),
      )
      // .pipe(htmlReplace())
      .pipe(typograf({locale: ["ru", "en-US"]}))
      // .pipe(htmlMin({ collapseWhitespace: true }))
      .pipe(gulp.dest(DEST))
      .pipe(connect.reload())
  );
});

// Styles
gulp.task("styles", () => {
  return gulp
    .src("src/assets/styles/main.scss")
    .pipe(gulpif(isDev, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(autoprefixer({
      cascade: false
    }))
    .pipe(groupMedia())
    .pipe(cleanCss({
      level: {
        2: {
          restructureRules: true
        }
      }
    }))
    .pipe(pxToRem('16px'))
    .pipe(cssNano())
    .pipe(gulpif(isDev, sourcemaps.write(".")))
    .pipe(rename("style.min.css"))
    .pipe(gulp.dest(`${DEST}`))
    .pipe(connect.reload());
});

// Scripts
gulp.task("scripts", () => {
  return browserify("src/assets/scripts/main.js", {debug: true})
    .transform(babelify, {presets: ["@babel/env"]})
    .bundle()
    .pipe(source("bundle.min.js"))
    .pipe(buffer())
    .pipe(gulpif(isDev, sourcemaps.init({loadMaps: true})))
    .pipe(gulpif(isProd, terser()))
    // .pipe(gulpif(isProd, uglify()))
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest(`${DEST}`))
    .pipe(connect.reload());
});

gulp.task("watch", () => {
  gulp.watch("src/assets/styles/**/*.scss", gulp.series("styles"));
  gulp.watch("src/assets/scripts/**/*.js", gulp.series("scripts"));
  gulp.watch("src/templates/**/*.hbs", gulp.series("html"));
  gulp.watch("src/assets/images/**/*", gulp.series("images"));
  gulp.watch("src/assets/images/svg/**/*", gulp.series("sprites"));
});

/**
 * General tasks
 */
gulp.task("dev", gulp.series("clean-dest", "html", "styles", "scripts", "fonts", "images", "sprites", gulp.parallel("connect", "watch")));
gulp.task("build", gulp.series("clean-dest", "html", "styles", "scripts", "fonts", "images", "sprites", "favicon"));
