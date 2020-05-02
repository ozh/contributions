<?php

// http://cdn.shopify.com/s/files/1/0051/4802/products/contribution-4_1024x1024.jpg?100
// session_start();


$words = isset( $_GET['text'] ) ? urldecode( $_GET['text'] ) : 'I CODE';

$cell_size = isset( $cell_size ) ? $cell_size : 10 ;
$margin = floor( $cell_size / 5 );

$im_width = 53 * ( $cell_size + $margin ) + $margin;
$im_height = 7 * ( $cell_size + $margin ) + $margin;



$im = imagecreatetruecolor ( $im_width, $im_height ) or die( 'Cannot Initialize new GD image stream' );

$white = imagecolorallocate( $im, 255, 255, 255 );
$red = imagecolorallocate( $im, 255, 0, 0 );
imagecolortransparent( $im, $red );

$colors = array(
	imagecolorallocate( $im, 238, 238, 238 ), // #EEEEEE
	imagecolorallocate( $im, 214, 230, 133 ), // #D6E685
	imagecolorallocate( $im, 140, 198, 101 ), // #8CC665
	imagecolorallocate( $im,  68, 163,  64 ), // #44A340
	imagecolorallocate( $im,  30, 104,  35 ), // #1E6823
);

$letters = array(
	'a' => array ( '000', '111', '001', '111', '101', '111', '000', ), 
	'b' => array ( '000', '100', '100', '111', '101', '111', '000', ), 
	'c' => array ( '000', '000', '111', '100', '100', '111', '000', ), 
	'd' => array ( '000', '001', '001', '111', '101', '111', '000', ), 
	'e' => array ( '000', '111', '101', '111', '100', '111', '000', ), 
	'f' => array ( '000', '000', '111', '100', '110', '100', '000', ), 
	'g' => array ( '000', '000', '111', '101', '111', '001', '011', ), 
	'h' => array ( '000', '000', '100', '111', '101', '101', '000', ), 
	'i' => array ( '0', '1', '0', '1', '1', '1', '0', ), 
	'j' => array ( '00', '01', '00', '01', '01', '11', '00', ), 
	'k' => array ( '000', '000', '100', '101', '110', '101', '000', ), 
	'l' => array ( '0', '0', '1', '1', '1', '1', '0', ), 
	'm' => array ( '00000', '00000', '01011', '10101', '10101', '10101', '00000', ), 
	'n' => array ( '000', '000', '011', '101', '101', '101', '000', ), 
	'o' => array ( '000', '000', '111', '101', '101', '111', '000', ), 
	'p' => array ( '000', '000', '011', '101', '111', '100', '100', ), 
	'q' => array ( '000', '000', '110', '101', '111', '001', '001', ), 
	'r' => array ( '000', '000', '010', '101', '100', '100', '000', ), 
	's' => array ( '000', '000', '011', '100', '001', '110', '000', ),
	't' => array ( '000', '000', '010', '111', '010', '011', '000', ), 
	'u' => array ( '000', '000', '000', '101', '101', '111', '000', ), 
	'v' => array ( '000', '000', '000', '101', '101', '010', '000', ), 
	'w' => array ( '00000', '00000', '00000', '10101', '10101', '01010', '00000', ), 
	'x' => array ( '000', '000', '000', '101', '010', '101', '000', ), 
	'y' => array ( '000', '000', '000', '101', '111', '001', '010', ), 
	'z' => array ( '000', '000', '111', '001', '100', '111', '000', ), 
	/**/
	'A' => array ( '0000', '0110', '1001', '1111', '1001', '1001', '0000',  ), 
	'B' => array ( '0000', '1110', '1001', '1110', '1001', '1110', '0000',  ), 
	'C' => array ( '0000', '0111', '1000', '1000', '1000', '0111', '0000',  ), 
	'D' => array ( '0000', '1110', '1001', '1001', '1001', '1110', '0000', ), 
	'E' => array ( '0000', '1111', '1000', '1110', '1000', '1111', '0000', ), 
	'E' => array ( '000', '111', '100', '110', '100', '111', '000', ), 
	'F' => array ( '000', '111', '100', '110', '100', '100', '000', ), 
	'G' => array ( '0000', '0110', '1000', '1011', '1001', '0110', '0000', ), 
	'H' => array ( '0000', '1001', '1001', '1111', '1001', '1001', '0000', ), 
	'I' => array ( '000', '111', '010', '010', '010', '111', '000', ), 
	'J' => array ( '0000', '0111', '0010', '0010', '1010', '1110', '0000', ), 
	'K' => array ( '0000', '1001', '1010', '1100', '1010', '1001', '0000', ), 
	'L' => array ( '000', '100', '100', '100', '100', '111', '000', ), 
	'M' => array ( '00000', '10001', '11011', '10101', '10001', '10001', '00000', ), 
	'N' => array ( '0000', '1001', '1101', '1011', '1001', '1001', '0000', ), 
	'O' => array ( '0000', '0110', '1001', '1001', '1001', '0110', '0000', ), 
	'P' => array ( '000', '111', '101', '111', '100', '100', '000', ), 
	'Q' => array ( '0000', '0110', '1001', '1001', '1001', '0110', '0011', ), 
	'R' => array ( '0000', '1111', '1001', '1111', '1010', '1001', '0000', ), 
	'S' => array ( '0000', '0111', '1000', '0110', '0001', '1110', '0000', ), 
	'T' => array ( '000', '111', '010', '010', '010', '010', '000', ), 
	'U' => array ( '0000', '1001', '1001', '1001', '1001', '0110', '0000', ), 
	'V' => array ( '000', '101', '101', '101', '101', '010', '000', ), 
	'W' => array ( '00000', '10001', '10001', '10101', '10101', '01010', '00000', ), 
	'X' => array ( '000', '101', '101', '010', '101', '101', '000', ), 
	'Y' => array ( '000', '101', '101', '010', '010', '010', '000', ), 
	'Z' => array ( '0000', '1111', '0010', '0100', '1000', '1111', '0000', ), 
	/**/
	' ' => array ( '0', '0', '0', '0', '0', '0', '0', ), 
	'-' => array ( '00', '00', '00', '11', '00', '00', '00', ), 
	'+' => array ( '000', '000', '010', '111', '010', '000', '000', ), 
	'*' => array ( '000', '000', '101', '010', '101', '000', '000', ), 
	'!' => array ( '0', '1', '1', '1', '0', '1', '0', ),
	'?' => array ( '000', '111', '001', '010', '000', '010', '000', ), 
	'.' => array ( '0', '0', '0', '0', '0', '1', '0', ), 
	')' => array ( '00', '10', '01', '01', '01', '10', '00', ), 
	'(' => array ( '00', '01', '10', '10', '10', '01', '00', ), 
	':' => array ( '0', '0', '1', '0', '1', '0', '0', ), 
	',' => array ( '00', '00', '00', '01', '01', '10', '00', ), 
	';' => array ( '00', '00', '01', '00', '01', '10', '00', ), 
	'<' => array ( '000', '001', '010', '100', '010', '001', '000', ), 
	'>' => array ( '000', '100', '010', '001', '010', '100', '000', ), 
	'=' => array ( '000', '000', '111', '000', '111', '000', '000', ), 
	"'" => array ( '0', '1', '1', '0', '0', '0', '0', ), 
	'"' => array ( '000', '101', '101', '000', '000', '000', '000', ), 
	'$' => array ( '000', '010', '111', '110', '011', '111', '010', ), 
	'/' => array ( '000', '000', '001', '010', '100', '000', '000', ), 
	'\\' => array ( '000', '000', '100', '010', '001', '000', '000', ), 
	/**/
	'1' => array ( '00', '01', '11', '01', '01', '01', '00', ), 
	'2' => array ( '000', '010', '101', '001', '010', '111', '000', ), 
	'3' => array ( '000', '110', '001', '010', '001', '110', '000', ), 
	'4' => array ( '000', '001', '010', '100', '111', '001', '000', ), 
	'5' => array ( '000', '111', '100', '011', '001', '111', '000', ), 
	'6' => array ( '000', '011', '100', '111', '101', '111', '000', ), 
	'7' => array ( '000', '111', '001', '010', '010', '010', '000', ), 
	'8' => array ( '000', '111', '101', '111', '101', '111', '000', ), 
	'9' => array ( '000', '111', '101', '111', '001', '110', '000', ), 
	'0' => array ( '000', '010', '101', '101', '101', '010', '000', ), 
	/**/
	'¤' => array ( '00000', '11011', '11111', '11111', '01110', '00100', '00000', ), // heart
);




$length = strlen( $words );

$width = 0;

// Matrix for all words
$ascii = array( '', '', '', '', '', '', '' );

// word length measured in cells
for( $i = 0 ; $i < $length ; $i++ ) {
	$let_width = isset( $letters[ $words[ $i ] ] ) ? strlen( $letters[ $words[ $i ] ][0] ) : 0 ;
	$width += $let_width;
	if( $i < ( $length - 1 ) )
		$width++;
	
	for( $z=0 ; $z < 7 ; $z++ ) {
		$ascii[ $z ] .= isset( $letters[ $words[ $i ] ] ) ? $letters[ $words[ $i ] ][ $z ] : '';
		if( $i < ( $length - 1 ) )
			$ascii[ $z ] .= '0';
		
	}
}

$safe = floor( ( 50 - $width ) / 2 );


// Paint in white
imagefill( $im, 0 , 0 , $white );

// Random contributions
for( $week = 0; $week < 53; $week++ ) {
	$start_week = $week == 0 ? true : false;
	$last_week = $week == 52 ? true : false;
	for( $day = 0; $day < 7; $day++ ) {
		if( ( $start_week && $day < 3 ) || ( $last_week && $day > 3 ) ) {
			$color = $red;
			$offset1 = $offset2 = $margin;
			if( $last_week )
				$offset1 = 0;
		} else {
			$max_color = ( $week < $safe || $week > 52 - $safe ) ? 3 : 1 ;
			$color = $colors[ mt_rand( 0, $max_color ) ];
			$offset1 = $offset2 = 0;
		}
		$x1 = $week * ( $cell_size + $margin ) + $margin - $offset1;
		$y1 = $day  * ( $cell_size + $margin ) + $margin - $offset1;
		$x2 = $x1 + $cell_size + $offset2 - 1;
		$y2 = $y1 + $cell_size + $offset2 - 1;
		imagefilledrectangle( $im, $x1, $y1, $x2, $y2, $color );
		//imagestring( $im, 3, $x1 + 3, $y1 + 3, "$week-$day", $colors[4] );
	}
}

// Letters
for( $week = 0 ; $week < $width ; $week++ ) {
	for( $day = 0 ; $day < 7 ; $day++ ) {
		$line = $ascii[ $day ];
		if( $line[ $week ] == 1 ) {
			$_week = $week + 26 - floor( $width / 2 );
			$x1 = $_week * ( $cell_size + $margin ) + $margin;
			$y1 = $day  * ( $cell_size + $margin ) + $margin;
			$x2 = $x1 + $cell_size - 1;
			$y2 = $y1 + $cell_size - 1;
			imagefilledrectangle( $im, $x1, $y1, $x2, $y2, $colors[4] );
		}
	}
}






header("Content-type: image/png");
imagepng( $im );
imagedestroy( $im );

/*


*/