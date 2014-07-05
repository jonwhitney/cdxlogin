<?php

class foundationStructure{
    
    /**
     * This method renders the foundation header
     * @param str $title -- Page title
     */
    public function renderHeader($title){
        
        print '
            <!doctype html>
            <html class="no-js" lang="en">
              <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>'. $title .'</title>
                <link rel="stylesheet" href="foundation/foundation1.css" />
                <link rel="stylesheet" href="foundation/foundation2.css" />

              </head>
              <body>

                <div class="row">
                  <div class="large-12 columns">
                    <h1>'. $title .'</h1>
                  </div>
                </div>';
        
    }    
    
    public function renderFooter(){
        print '
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script src="/Source Files/foundation/foundation.min.js"></script>
                <script>
                  $(document).foundation();
                </script>
              </body>
            </html>';
    }
    
}