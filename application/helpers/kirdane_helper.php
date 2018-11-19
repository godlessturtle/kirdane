<?php 
/*
function seo($s) {
	$tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','Ê','ê','û','Û','î','Î');
	$eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','', 'E', 'e', 'u', 'u', 'i', 'I');
	$s = str_replace($tr,$eng,$s);
	$s = strtolower($s);
	$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
	$s = preg_replace('/\s+/', '-', $s);
	$s = preg_replace('|-+|', '-', $s);
	$s = preg_replace('/#/', '', $s);
	$s = str_replace('.', '', $s);
	$s = trim($s, '-');
	return $s;
}
*/


function the_excerpt($excerpt, $limit=40){

    $excerpt = preg_replace(" ([.*?])",'',$excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
    $excerpt = $excerpt."...";
    return $excerpt;
}



function seo($str, $options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


function test($slug){
    $data = array(
        'test' => "234324"
    );
    return $data[$slug];
}


function dateTranslate($string){
	$monthsEng = array(
		'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); 
	$monthsTr = array(
		'Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık');
	return str_replace($monthsEng, $monthsTr, $string);
}


function permalinkCreator($param, $id, $title){
	$url = $param ."/" . $id . "/" . seo($title);
	$permalink = base_url($url);
	return $permalink;
}


function limitChars($string, $limit, $delimiter="..."){
    if(strlen($string) < $limit){
        $returnedString = mb_substr($string, 0, $limit);
    }else{
        $returnedString = mb_substr($string, 0, $limit) . $delimiter;
    }
    return $returnedString;

}

//xss filtering
//security library yüklü olması lazım
function clear($string){
    $string = addslashes(trim($string));
    $string = remove_invisible_characters($string);
    $string = html_escape($string);
    $ci =& get_instance();
    return $ci->security->xss_clean($string);
}


function getCatName($id){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM categories JOIN posts ON categories.cat_id=posts.post_category WHERE post_id="'.$id.'"');
	return $query->result();
}


function getCatNameByID($cat_id){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('categories', array('cat_id' => $cat_id));
	return $query->result();
}


function tags($tags){
	return explode (",",$tags);
}

function catPostCount($id){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('posts', array('post_category' => $id));
	return $query->num_rows();
}



function getAuthorInfo($id){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('users', array('user_id'=>$id));
	return $query->result();
}


function postCount($post_author){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('posts', array('post_author'=>$post_author));
	return $query->num_rows();
}


function postCategory($post_id){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('posts', array('post_id'=>$post_id));
	return $query->result();
}


function commentCount($post_id){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('comments', array('whichPost'=>$post_id, 'isApproved' => 1));
	return $query->num_rows();
}


function unApprovedComments(){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('comments', array('isApproved' => 0));
	return $query->num_rows();
}


function getPages(){
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where('pages', array('isApproved' => 1));
	return $query->result();
}

function megaPopular($cat_id){
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->order_by('post_views', 'DESC')->get_where('posts', array('post_category' => $cat_id), 5);
    return $query->result();
}

function megaRecent($cat_id){
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->order_by('post_id', 'DESC')->get_where('posts', array('post_category' => $cat_id), 3);
    return $query->result();
}

function subMenus($id){
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->get_where('menus', array('topLevel' => $id));
    return $query->result();
}

function subMenuTitle($id){
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->get_where('menus', array('menu_id' => $id));
    return $query->result();
}

function recentPostsFooter($postCount){
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->order_by('post_id', 'DESC')->get_where('posts', array('isDraft' => 0), $postCount);
    return $query->result();
}

function userDetails($user_id){
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->get_where('users', array('user_id' => $user_id));
    return $query->result();
}

function userDetailsByMail($user_mail){
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->get_where('users', array('user_email' => $user_mail));
    return $query->result();
}

function create_uniq($length = 7){
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l',
        'm', 'n','o','p','r','s','t', 'u', 'v', 'y','z', 'w', 'x',
        0,1,2,3,4,5,6,7,8,9
    );
    $rands = array();
    for($i=0; $i<=$length; $i++){
        array_push($rands, $chars[array_rand($chars)]);
    }
    $string = implode(',', $rands);
    return str_replace(',','', $string);
}

?>