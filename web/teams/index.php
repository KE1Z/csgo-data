<!DOCTYPE html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CSGO Team In-game logos
    </title>
    <link href="//cdn.jsdelivr.net/bootswatch/3.3.1.2/paper/bootstrap.min.css" rel="stylesheet">
    <style>
        table tbody > tr > td.vertical-middle {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>
            Available teams
            <a class="btn btn-primary pull-right" href="all.zip">
                Download zip with all teams
            </a>
        </h2>
        <table class="table table-hover">
            <tbody>
                <?php
                $items = scandir( '.' );
                $teamList = array();
                $skiplist = array( '.', '..', 'index.php' );
                foreach( $items as $item ) :
                    if( in_array( $item, $skiplist ) ) :
                        continue;
                    endif;

                    $dotPosition = strpos( $item, '.' );

                    $identifier = substr( $item, 0, $dotPosition );

                    if( empty( $identifier ) ) :
                        continue;
                    endif;

                    if( !isset( $teamList[ $identifier ] ) ) :
                        $teamList[ $identifier ] = new stdClass();
                        $teamList[ $identifier ]->identifier = $identifier;
                    endif;

                    switch( substr( $item, $dotPosition + 1 ) ) :
                        case 'png':
                            $teamList[ $identifier ]->hasImage = true;
                            break;
                        case 'cfg':
                            $teamList[ $identifier ]->hasConfig = true;
                            $file = fopen( $item, 'r' );
                            $teamList[ $identifier ]->name = fread( $file, filesize( $item ) );
                            fclose( $file );
                            break;
                        case 'zip':
                            $teamList[ $identifier ]->hasZip = true;
                            break;
                    endswitch;
                endforeach;
                foreach( $teamList as $team ) :
                    if( !isset( $team->hasImage ) || !$team->hasImage ) :
                        continue;
                    endif;
                    ?>
                    <tr>
                        <td class="vertical-middle">
                            <img src="<?php echo $team->identifier, '.png'; ?>">
                        </td>
                        <td>
                            <p class="lead">
                                <?php
                                if( $team->hasConfig ) :
                                    echo $team->name;
                                else :
                                    ?>
                                    ???
                                    <?php
                                endif;
                                ?>
                            </p>
                            <em>
                                <?php echo $team->identifier ?>
                            </em>
                        </td>
                        <td class="text-right vertical-middle">
                            <?php
                            if( $team->hasImage ) :
                                ?>
                                <a class="btn btn-sm btn-primary" href="<?php echo $team->identifier, '.png'; ?>">
                                    Download logo
                                </a>
                                <?php
                            endif;
                            ?>
                        </td>
                        <td class="text-right vertical-middle">
                            <?php
                            if( $team->hasConfig ) :
                                ?>
                                <a class="btn btn-sm btn-primary" href="<?php echo $team->identifier, '.cfg'; ?>">
                                    Download config
                                </a>
                                <?php
                            endif;
                            ?>
                        </td>
                        <td class="text-right vertical-middle">
                            <?php
                            if( $team->hasZip ) :
                                ?>
                                <a class="btn btn-sm btn-primary" href="<?php echo $team->identifier, '.zip'; ?>">
                                    Download zip with logo and config
                                </a>
                                <?php
                            endif;
                            ?>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-3953312-24', 'auto');
        ga('send', 'pageview');
    </script>
</body>
