<?php
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 14.09.2018
 * Time: 16:18
 */
function lang($slug, $lang=0)
{
    $lang = array(
        /*Anasayfa*/
        'readMore'              => "Devamını Oku",
        'delete'                => 'Sil',
        'submit'                => 'Gönder',

        /* Tekil yazı sayfası */
        'member'                => "Üye",
        'admin'                 => "Yönetici",
        'name'                  => "Ad-Soyad",
        'comment'               => "Yorumunuz",
        'submitComment'         => "Yorum Gönder",
        'commentCondt'          => "**Yorumunuz yönetici onayından geçtikten sonra yayınlanacak.",
        'commentErr'            => 'Bir Hata Oluştu, Lütfen Tekrar Deneyin!',
        'posts'                 => "İçerik",
        'tags'                  => "Etiketler",
        'shareThis'             => "Bu yazıyı paylaş",
        'seeAuthors'            => "Tüm Yazarları Gör",
        'relatedPosts'          => "Benzer Yazılar",
        'author'                => "Yazar",
        'commentInfo'           => "Yorumunuzu buraya yazın",
        'comments'              => "Yorum",
        'noComment'             => "Yorum Yok",
        'newestArticles'        => "En Yeni İçerikler",
        'details'               => "Detay",
        'writeComment'          => "Bir yorum yaz",


        /*sidebar*/
        'popularArticles'       => "Popüler Yazılar",
        'recentComments'        => "Son Yorumlar",
        'randomPosts'           => "Rastgele Yazılar",

        'searchT'               => "İçeren Yazılar Görüntüleniyor.",


        /* Header/menu*/
        'recentPosts'           => "Son Yazılar",
        'popularPostsHeader'    => "Trend Olanlar",
        'register'              => "Kaydol",
        'login'                 => "Giriş",
        'profile'               => "Profilim",
        'logout'                => "Çıkış",
        'searchBox'             => "Ara",

        /* Kullanıcı Profili */
        'myProfile'             => 'Profilim',
        'createNewPost'         => 'Yeni Yazı Oluştur',
        'postNotification'      => '* Yazınız yönetici onayından sonra yayınlanacak.',
        'postTitle'             => 'Başlık',
        'postTags'              => 'Etiketler',
        'postContent'           => 'Yazı İçeriği',
        'postCategory'          => 'Kategori',
        'postImg'               => 'Yazı Resmi',

        'fullName'              => 'Ad Soyad',
        'aboutMe'               => 'Hakkımda',
        'profileImg'            => 'Profil Resmi',
        'coverImg'              => 'Kapak Resmi',
        'submitUpdate'          => 'Güncelle',

        'myPosts'               => 'Yazılarım',
        'postsTitle'            => 'Başlık',
        'status'                => 'Durum',
        'date'                  => 'Tarih',
        'functions'             => 'İşlem',
        'tags'                  => 'Yazı Etiketleri',
        'post_text'             => 'Yazı İçeriği',

        'waitingC'              => 'Onay Bekliyor',
        'approvedA'             => 'Onaylandı',

        'passwordF'             => 'Şifre İşlemleri',
        'oldPass'               => 'Eski Şifre',
        'newPass'               => 'Yeni Şifre',
        'rePass'                => 'Yeni Şifre Tekrarı',

        //kategori sayfası
        'cat_posts'             => 'Kategorisindeki yazılar listeleniyor.'





    );
    return html_escape($lang[$slug]);
}


function exprs($slug, $lang=0)
{
    $expr = array(
        /* T -> Controller Strings */
        'error'                 => 'Hata!',
        'success'               => 'Başarılı',
        'warning'               => 'Uyarı',

        'captcha_err'           => 'Güvenlik Kodu Hatalı',
        'post_exists'           => 'Böyle bir yazı zaten var',
        'waiting_c'             => 'Yazınız Gönderildi ve Onay Bekliyor',
        'approved_a'            => 'Yazınız Gönderildi ve Otomatik Olarak Onaylandı',
        'format_exception'      => 'Sadece .png, .jpg ve .jpeg uzantılı dosyalar yüklenebilir.',
        'empty_exception'       => 'Yazı Resmi Alanı Boş Olamaz',
        'user_exists'           => 'Bu mail adresi zaten kayıtlı',
        'updatedScf'            => 'Bilgileriniz Güncellendi',
        'deletedScf'            => 'Yazınız Silindi',
        'ntMatches'             => 'Şifreler Eşleşmiyor.',
        'uncaught_err'          => 'Geçersiz İşlem, KOD: 254923',
        't_valid_email'         => 'Geçerli bir mail adresi belirtiniz.',

        'cap_code'              => 'Doğrulama Kodu',
        'e_mail'                => 'E-Posta',
        'pass'                  => 'Şifre',

        'tags'                  => 'Yazı Etiketleri',
        'post_text'             => 'Yazı İçeriği',

        'log_in_msg'            => 'Bu sayfayı görüntülemek için oturum açın!',
        'createdScf'            => 'Kaydınız oluşturuldu, şimdi giriş yapabilirsiniz!',

        'lg_error'              => 'Giriş Bilgileri Hatalı!',


        /* S -> Form Validation Strings */
        'fullName'              => 'Ad Soyad',
        'aboutMe'               => 'Hakkımda',
        'oldPass'               => 'Eski Şifre',
        'newPass'               => 'Yeni Şifre',
        'rePass'                => 'Yeni Şifre Tekrarı',
        'requiredInput'         => '{field} alanının doldurulması zorunludur!',
        'ntMatches'             => 'Şifre alanları eşleşmiyor!'

    );
    return '"'.html_escape($expr[$slug]).'"';
}
?>