<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--[if IE]>
        <script>
            document.createElement('header');
            document.createElement('nav');
            document.createElement('section');
            document.createElement('article');
            document.createElement('aside');
            document.createElement('footer');
        </script>
    <![endif]-->
    <style>
        /**
         * Reset
         * 
         * @license none (public domain)
         * @link    http://meyerweb.com/eric/tools/css/reset/
         * @version v2.0 | 20110126
         */
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed, 
        figure, figcaption, footer, header, hgroup, 
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure, 
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        /** Common */
        body {
            padding: 2% 0 0;
            font: 14px/22px Verdana, Tahoma, Arial, Helvetica;
            color: #696969;
            background: #fff
        }

        /** Tags */
        h1 {
            font-size: 30px;
            line-height: 40px;
        }

        h2 {
            font-size: 26px;
            line-height: 34px
        }

        h3 {font-size: 22px}

        h4 {font-size: 18px}

        h5 {font-size: 16px}

        h6 {font-size: 14px}

        p {margin: 15px 0}

        /** Common classes */
        .border-rounded {
            border-radius: 10px;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            -khtml-border-radius: 10px
        }

            /** Wrapper */
            #wrapper {
                width: 800px;
                margin: 0 auto;
                border: 1px solid #ccc
            }
            
                #wrapper header h1 {
                    margin: 20px 0;
                    text-align: center
                }
            
                #wrapper article {margin: 40px}
                
                    #wrapper article header h2 {margin-bottom: 25px}
    </style>
    <title><?php echo $title ?></title>
</head>
<body>
    <section id="wrapper" class="border-rounded">
        <?php echo $message ?>
    </section>
</body>
</html>
