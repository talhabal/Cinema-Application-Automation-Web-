<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<h2>SİNEMA OTOMASYONU</h2>
<h3>Sinema salonu personeli ve web arayüzünden bilet almak isteyen müşteriler için hazırlanan bir sistemdir.</h3>
<h4>* Web Arayüzü PHP dilinde yazılmıştır. <br>
* Otomasyon kısmı C# ile yazılmıştır. <br>
* MSSQL Server veritabanı kullanılmış olup her iki sistemde aynı veritabanına bağlanmıştır. <br>
* C# ile yazarken Visual Studio Manager Windows Form Application ile çalışıldı. <br>
* PHP ile yazarken Visual Studio Code programı ile çalışıldı. <br>
* Kullanılan veri tabanını kendi SQL SERVER veri tabanınıza eklemek için şu adımları uygulayın; <br>
1-)C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS\MSSQL\DATA içerisine projenin sql klasörü içindeki sinema_otomasyon.mdf ve sinema_otomasyon_log.ldf dosyalarını atın. <br>
2-)SQL Server'ı açıp Database üzerinde sağ tıklayın. Attach seçeneği ile açılan ekranda Add butonuna tıklayın. <br>
3-)sinema_otomasyon.mdf dosyasını seçip OK butonuna tıklayın. <br>
4-)Attach Database ekranında sinema_otomasyon.mdf ve sinema_otomasyon_log.ldf dosyaları gözükecek. Alttaki OK butonuna tıklayın. <br>
5-)Veri tabanınıza ekleme işlemini SQL SERVER'da refresh yaparak görebilirsiniz. <br>
</h4>
<h5>
	Otomasyonun form uygulamasını personel kullanabilmektedir. Öncelikle personel kullanıcı adi ve şifresi ile giriş yaması gerekiyor. Giriş yapıldığında karşısına çıkan formun üst kısmında "FİLM EKLE" , "FİLM GÜNCELLE" , "İŞLEMLER" , "AYARLAR" ve "ÇIKIŞ" butonları yer alıyor. <br>
	Content kısmında ise filmlere atanan seanslar ile birlikte listeleme yapılıp herhangi birini seçtiğinizde sağ tarafta filmin afişi gösteriliyor. Filmler arasında arama yapabilmek için dataGridWiev'ın hemen üstündeki arama kısmına filmin adı , salon adı ve seans saatine göre arama yapabiliriz. Müşterinin personel sayesinde bilet alabilmesi için personel listenen filmlerden seçip "BİLET" butonuna nasması gerekiyor. "BİLET" butonuna tıklandığında personelden müşteri ismi , koltuk seçimi ve müşteri tipini seçmesi bekleniyor. Bilgileri girdikten sonra ilgili filmin seansına koltuk alınabiliyor. <br>
	"FİLM EKLE" butonuna tklandığında filmin adı , çıktığı yılı , kategorisi , yapımcısı , yönetmeni , oyuncuları ve afişini ekleme sayfası yer alıyor. Bu sayede filmler tablomuza eklemiş oluyoruz. Ancak ana sayfaya dönüp baktığımızda listelenmediğini farkedeceksiniz. Bunun sebebi siz sadece film eklediniz. Bu filme salon , seans ve tarih ekleme işlemlerini "İŞLEMLER" sayesinde yapabilirsiniz. <br>
	"FİLM GÜNCELLE" butonuna tıklandığında eklenen filmler üzerinde silme ve güncelleme işlemleri yapılıyor. <br>
	"İŞLEMLER" butonuna tıklandığında açılan form sayfasının sol kısmında yer alan yönetmen , kategori , yapımcı , oyuncu , seans ve salon ile ilgili ekleme silme ve güncelleme işlemleri yapabilirsiniz. Film Seans'a tıklandığında ise eklediğimiz filmlerden seçip bu filme tarih , seans ve salon ataması yapmamız gerekiyor. İşte bu sayede ana sayfamızda listelenen tabloya eklemiş oluyoruz. <br>
</h5>
<h5>
	Otomasyonun web arayüzü olarak müşteriler kullanabilmektedir. Öncelikle kullanıcının siteye giriş yapması bekleniyor. Eğer giriş yapılmamışsa hiçbir filme bilet alamaz. Eğer siteye üye değilse header kısmında yer alan "KAYIT OL" tıklanarak üye olunabilir. <br>
	Giriş yapıldığında ise vizyonda ve seans tarihi geçmemiş olan filmler listeleniyor. Filmler sayfasında istenilen bir filme bilet rezerve edebilmek için filmin yanındaki takvim simgesine tıklamanız gerekmektedir. Bu simgeye tıkladığında hangi filmi seçtiyseniz o filmin tüm bilgileri yer alıyor. Alt kısımda ise dolu oan koltukları listeleyip combobox sayesinde boş olan koltuklardan birini bilet alabilir. Kullanıcı koltuğunu ve müşteri tipini seçtikten sonra "BİLET AL" butonuna tıklıyor ve sayfa yenileniyor. Tekrar koltuklara baktığımızda biraz önceki alınan koltuğun dolu olarak gözüktüğünü farkedeceksiniz. Kullanıcının aldığı biletleri görmek veya iptal etmek için menüde yer alan "PROFİL" kısmına tıklanması gerekiyor. Profil sayfasında ise aldığı biletler listelenip iptal etmek istediği filmi silebilir. Sağ kısımda ise hangi kullanıcı giriş yaptıysa onun kayıt olurken girdiği bilgiler yer alıyor. Bu kısımda kendi bilgilerini güncelleme işlemini yapabilir
</h5>



</body>
</html>
