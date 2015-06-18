<?php
/*
Plugin Name: SAMM Self Assessment 
Plugin URI: http://www.bm-support.org
Description: Software Assurance Maturity Model (SAMM) self Assessment for Wordpress powered sites
Version: 0.1
Author: Maikel Mardjan
Author URI: http://www.organisatieontwerp.nl
License: GPL3
*/

/*
 * All SAMM questions in this assessment are based on the OWASP project:
 * The Software Assurance Maturity Model (SAMM) was originally developed, designed, and written by
Pravir Chandra (chandra@owasp.org).
 * This Wordpress pluging contains slighly modified questions of SAMM1.1 draft. 
 * See: http://www.opensamm.org/ for more information on SAMM and available (free) material to IT security within your organisation
 */

//(Yet Another Link Libarary- version2)
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Start session for human validation (and prevent resending by browser refresg (F5)
if (!isset ($_SESSION)) session_start(); 
//$_SESSION['samm'] = isset($_SESSION['bms-rand']) ? $_SESSION['bms-rand'] : rand(1, 20);

function bms_jqm() {
 wp_register_script('jqm_js',plugins_url('/js/multistep.js', __FILE__));
 wp_enqueue_script( 'jqm_js');
 
wp_register_style( 'jqm_css', plugins_url('/css/tabs.css',__FILE__));
wp_enqueue_style( 'jqm_css');
wp_enqueue_script('jquery');
 }
add_action('wp_enqueue_scripts', 'bms_jqm');

//Create form for creating architecture design
add_shortcode('samm', 'bms_samm_form');
function bms_samm_form(){
 $output='';
    if (!isset ($_POST['finish'])) { 
        bms_get_form();
    } 
    else {
            $nonce = $_POST['_wpnonce'];
            if ( ! wp_verify_nonce( $nonce, 'sammsa' ) ) {
            // This nonce is not valid.
            die( 'Security check' ); 
            } else {
                // The nonce was valid.
            // Do stuff here.
        
        $totals=$_POST['totals'];
           $gq_input = isset($_POST['gq']) ? $_POST['gq'] : null;
            $pcq_input = isset($_POST['pcq']) ? $_POST['pcq'] : null;
            $egq_input = isset($_POST['egq']) ? $_POST['egq'] : null;
            $cq_input = isset($_POST['cq']) ? $_POST['cq'] : null;
            $rq_input = isset($_POST['rq']) ? $_POST['rq'] : null;
            $aq_input = isset($_POST['aq']) ? $_POST['aq'] : null;
            $vq_input = isset($_POST['vq']) ? $_POST['vq'] : null;


        $score_gq=count($gq_input);          
        $score_pcq=count($pcq_input);
        $score_egq=count($egq_input);
        $score_cq=count($cq_input);
        $score_rq=count($rq_input);
        $score_aq=count($aq_input);
        $score_vq=count($vq_input);
        
        $output.='<table  style="width:50%">';
        $output.='<tr><th>Security Aspect</th><th>score</th><th>Percentage (60% or higher recommended)</th></tr>';
        $output.='<tr><td>Governance</td><td>' . $score_gq *10 . '</td> <td>' . round(($score_gq / $totals[0]) *100) . '%</td></tr>';              
        $output.='<tr><td>Policy & Compliance</td><td>'. $score_pcq *10 . '</td><td>' . round(($score_pcq / $totals[1])*100) . '%</td></tr>';
        $output.='<tr><td>Education and Guidance</td><td>'. $score_egq *10 .'</td><td>' . round(($score_egq /$totals[2])*100) .'%</td></tr>'; ;
        $output.='<tr><td>Construction</td><td>'. $score_cq *10 .'</td><td>' .  round(($score_cq /$totals[3])*100) .'%</td></tr>'; 
        $output.='<tr><td>Security Requirements</td><td>'. $score_rq*10 . '</td><td>' . round(($score_rq /$totals[4])*100) .'%</td></tr>'; 
        $output.='<tr><td>Architecture</td><td>' . $score_aq *10 . '</td><td>' . round(($score_aq /$totals[5])*100) .'%</td></tr>'; 
        $output.='<tr><td>Verification </td><td>'. $score_vq *10 . '</td><td>'.  round(($score_vq /$totals[6])*100) .'%</td></tr>'; 
        $output.='</table>';
        
        
            }
    }
  
 
    return $output;
}

function bms_get_form(){


$govenancequestions=file(plugin_dir_path( __FILE__ ) . 'governancequestions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$pcquestions=file(plugin_dir_path( __FILE__ ) . 'pcquestions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$egquestions=file(plugin_dir_path( __FILE__ ) . 'egquestions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$constructionquestions=file(plugin_dir_path( __FILE__ ) . 'constructionquestions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$requirementsquestions=file(plugin_dir_path( __FILE__ ) . 'requirementsquestions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$architecturequestions=file(plugin_dir_path( __FILE__ ) . 'architecturequestions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$verificationquestions=file(plugin_dir_path( __FILE__ ) . 'verificationquestions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


?>
<ul id="signup-step">
	<li id="governance" class="active">Governance</li>
        <li id="policy">Policy & Compliance</li>
	<li id="education">Education & Guidance</li>
	<li id="construction">Construction</li>
        <li id="requirements">Security Requirements</li>
        <li id="architecture">Architecture</li>
        <li id="verification">Verification</li>
</ul>
<form name="frmRegistration" id="signup-form" method="post">

	<div id="governance-field">
            <table><tr>
<?php
$arrlength = count($govenancequestions);
for($x = 0; $x < $arrlength; $x++) {
    
    echo '<td>' . $govenancequestions[$x] . '</td>' ;
    echo '<td><input type="checkbox" name="gq[]'. '" id=gq'. $x. '" class="demoInputBox" /></td></tr>'; 
}
?>            
            </table></div>
 <div id="policy-field" style="display:none;">   
            <table><tr>
<?php
$arrlength = count($pcquestions);
for($x = 0; $x < $arrlength; $x++) {
    
    echo '<td>' . $pcquestions[$x] . '</td>' ;
    echo '<td><input type="checkbox" name="pcq[]' . '" id=pcq'. $x. '" class="demoInputBox" /></td></tr>'; 
}
?>          
      </table></div>
	
	<div id="education-field" style="display:none;">
                        <table><tr>
<?php
$arrlength = count($egquestions);
for($x = 0; $x < $arrlength; $x++) {
    
    echo '<td>' . $egquestions[$x] . '</td>' ;
    echo '<td><input type="checkbox" name="egq[]'. '" id=egq'. $x. '" class="demoInputBox" /></td></tr>'; 
}
?>          
      </table></div>
    
<div id="construction-field" style="display:none;">
		         <table><tr>
<?php
$arrlength = count($constructionquestions);
for($x = 0; $x < $arrlength; $x++) {
    
    echo '<td>' . $constructionquestions[$x] . '</td>' ;
    echo '<td><input type="checkbox" name="cq[]' . '" id=cq'. $x. '" class="demoInputBox" /></td></tr>'; 
}
?>          
      </table></div>
    
<div id="requirements-field" style="display:none;">
		                <table><tr>
<?php
$arrlength = count($requirementsquestions);
for($x = 0; $x < $arrlength; $x++) {
    
    echo '<td>' . $requirementsquestions[$x] . '</td>' ;
    echo '<td><input type="checkbox" name="rq[]' . '" id=rq'. $x. '" class="demoInputBox" /></td></tr>'; 
}
?>          
      </table></div>    
    <div id="architecture-field" style="display:none;">
		                <table><tr>                                     
<?php
$arrlength = count($architecturequestions);
for($x = 0; $x < $arrlength; $x++) {
    
    echo '<td>' . $architecturequestions[$x] . '</td>' ;
    echo '<td><input type="checkbox" name="aq[]' . '" id=aq'. $x. '" class="demoInputBox" /></td></tr>'; 
}
?>          
      </table></div>   
                                            
        <div id="verification-field" style="display:none;">
            <table><tr>
<?php
$arrlength = count($verificationquestions);
for($x = 0; $x < $arrlength; $x++) {
    
    echo '<td>' . $verificationquestions[$x] . '</td>' ;
    echo '<td><input type="checkbox" name="vq[]' . '" id=vq'. $x. '" class="demoInputBox" /></td></tr>'; 
}
?>          
      </table></div>   
                                        	
       <div>
		<input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
		<input class="btnAction" type="button" name="next" id="next" value="Next" >
		<input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
                <?php wp_nonce_field( 'sammsa');
                 #number of governance items
                $num_governance_questions=sizeof($govenancequestions);
                $num_pc_questions=sizeof($pcquestions);
                $num_eg_questions= sizeof($egquestions);
                $num_construction_questions=sizeof($constructionquestions);
                $num_requirements_questions=sizeof($requirementsquestions);
                $num_architecture_questions=sizeof($architecturequestions);
                $num_verification_questions=sizeof($verificationquestions);
                echo '<input type="hidden" name="totals[]" value="' . $num_governance_questions . '"/>';
                echo '<input type="hidden" name="totals[]" value="' . $num_pc_questions . '"/>';
                echo '<input type="hidden" name="totals[]" value="' . $num_eg_questions . '"/>';
                echo '<input type="hidden" name="totals[]" value="' . $num_construction_questions . '"/>';
                echo '<input type="hidden" name="totals[]" value="' . $num_requirements_questions . '"/>';
                echo '<input type="hidden" name="totals[]" value="' .  $num_architecture_questions . '"/>';
                echo '<input type="hidden" name="totals[]" value="' .  $num_verification_questions . '"/>';
                
                
?>
	</div>
</form>
<?php
return;

            
}