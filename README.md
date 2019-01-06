# portal-login

portal-login modülü http://portal.kouosl/ sitesinde yer alan giriş kısmına ek olarak kullanıcıya facebook ve google ile de giriş yapma imkanı veren bir kullanıcı modülüdür.
http://portal.kouosl/admin/login/auth adresi ile erişilen backend kısmında giriş yöntemlerinin seçilebildiği bu modül aynı zamanda data gridview yapısını kullanarak,
http://portal.kouosl/admin/login/login ile admin kullanıcısına kullanıcıları görüntüleme,silme ve düzenleme imkanı sunarken,http://portal.kouosl/login/login adresiyle
de normal kullanıcılara sunulan frontend ile diğer kullanıcıları görüntüleme olanağı vermektedir.

## Modül Kurulumu
 
Bu modülün kullanılabilmesi için daha önceden https://github.com/kouosl/portal adresinde belirtilen kurulum talimatları ile yerel makinanın kurulmuş olması ve ilgili sitelere 

-
1. Frontend URL: http://portal.kouosl
2. Backend URL: http://portal.kouosl/admin
3. Api URL: http://portal.kouosl/api

- 
erişilebiliyor olması gerekmektedir.

Gerekli makina kurumları tamamlandıktan sonra 

```
https://github.com/nejdetsarikaya3802/portal.git 
```

adresinde ki portal repositorysi clone ya da download edilerek ilgili portal klasöründeki gerekli değişiklikler update edilmelidir. Verilen adresten temin edilen portal klasörünün içersinde vendor dizini bulunmamaktadır. Kurulumun ileri aşamalarında dizine eklenecek dosyalardan bahsedilecektir.  


### Modül ekleme ve hazır hale getirme

Kullanılmak istenen login modülünü ve ana projeye ait fork edilip değiştirilmiş theme modülünün kullanılabilir hale getirilmesi için portal ana dizininde bulunan "composer.json" dosyası düzenlenilerek "repositories" dizisi içerisine bu iki modül resimde gösterildiği gibi url adresleriyle beraber eklenmelidir.


```
 "repositories": [
        ...
	    {
            "type": "vcs",
            "url": "https://github.com/nejdetsarikaya3802/portal-login.git"
        },
        {
            "type": "vcs",
            "url": "https://github.com/nejdetsarikaya3802/portal-theme.git"
        },
        ...
 ],
```
Daha sonra aynı dosya içerisinde bulunan "require" dizisi içerisine de ;

```
 "require": {
     ...
	"kouosl/portal-login": "dev-develop",
     ...
 },
```
satırı da eklenmelidir. 

Halledilen bu adımların ardından, console ekranında portal dizinine ulaştığımız ve "vagrant up" kodunu kullanarak ayağa kaldırdığımız yerel makinemize "vagrant shh" ile bağlantı kurduktan sonra cd /var/www/portal dizinine erişerek,
```
 sudo composer self-update
```
ile eklenilen modüllerin portal/vendor/kouosl altına çekilmesi sağlanır.
Bu login modülünde kullanılan giriş yöntemlerinin aktif hale gelebilmesi için portal-login modülü altında bulunan 

#### "yii2-authclient" klasörü portal/vendor/yiisoft içerisine 
## taşınmalıdır.

![client](https://user-images.githubusercontent.com/41762847/50738045-c9f2f480-11e0-11e9-990b-18f74e34732f.png)

Modülün çalışmak için ihityaç duyduğu iki database tablosu bulunmaktadır. Bunlardan 1. olan user tablosu sistem girişinin de kullandığı bir tablo olduğundandolayı hazır halde phpMyAdmin de bulunmaktadır. Yapmamız gereken 2. tabloyu da modülü kullanmaya başlamadan önce oluşturmaktır. bunun için modül dizini altında migrations klasörü içinde bulunan "m181226_222711_auth.php" adlı migration dosyasını portal ana dizininde yer alan migrations klasörüne taşımak ve portal dizini altında çalışan konsol ekranında,
```
 php yii migrate
```
komutunu çalıştırmaktır. Gelen soruya evet denilerek ilgili tablonun database tarafında oluşması sağlanır.
### Modül kullanımı 
```
http://portal.kouosl/login/auth
```
adresi ile,

![home](https://user-images.githubusercontent.com/41762847/50738098-6f0dcd00-11e1-11e9-9e72-cb3567bcb94e.png)

login modülünün anasayfasını görüyor olmamız gerekir. Değiştirlen sistem dili ile anasayfamızı ingilizce olarakta görebiliriz.

![home_en](https://user-images.githubusercontent.com/41762847/50738129-ca3fbf80-11e1-11e9-921f-2ad7e4f2c93e.png) 

login butonuyla devam edildiği taktirde karşımıza gelen login ekranında yerel kullanıcı bilgileriyle yahut facebook veya google ile login olunabilmektedir.

![login](https://user-images.githubusercontent.com/41762847/50738173-3d493600-11e2-11e9-9f15-e7bc8a074c61.png)

eğer sisteme yeni bir kullanıcı ile giriş yapılmak isteniyorsa sistemden loguot olduktan sonra direkt login butonu üzerindeki sign up bağlantısından ya da anasayfadaki signup butonundan kayıt penceresine erişilebilir.

![signup](https://user-images.githubusercontent.com/41762847/50738261-f14ac100-11e2-11e9-9c6a-70998cfa639f.png)

böylelikle login modülümüz kullanıma hazır hale gelmiş oluyor. 
Fork ettiğimiz theme modülünde yaptığımız çeşitli widget değişiklerinin yanı sıra gözle görülür değişiklikleri göstermek için kullandığımız custom css dosyamızı içerisinde 
```
!important;
```

kodunu kullanarak,
```
.navbar-inverse.navbar-fixed-top.navbar
{
  background-color: #c50804; !important;
  border-color: #82b366; !important;
}
```
şeklinde yaptığımız değişiklik ile yeni görüntümüzü elde ediyoruz.

![home_css](https://user-images.githubusercontent.com/41762847/50738572-8307fd80-11e6-11e9-9899-b966c364dd05.png)


## Konsol ile kullanım

Modülümüzün ilgili user tablosu üzerinde değişiklik yapmamızı sağlar.
Vagrant makinemize ssh ile bağlandıktan sonra cd /var/www/portal dizinine erişmemiz gerekmekterdir. Bu dizin altında,

```
php yii user
```
kod parçası ile örnek olarak databaseimizde bulunan toplam kullanıcı sayısını görebilmekteyiz. Diğer actionlar için,

```
php yii help
```
komutunu kullanarak gördüğümüz,
```
- user
    user/index (default)
    user/user
    user/user-batch
    user/user-delete
    user/user-update
```
bilgisi bize diğer metodları listelemektedir. Burada index default olarak kullanıcı sayısı, user metodu yeni bir kulanıcı eklemeyi,batch metodu kullanıcı grubu eklemeyi, delete le kullanıcı silmeyi ve update ile de id si verilen kullanıcıyı güncellemeyi yapabilmekteyiz.
## APİ

Rest API olarak bildiğimiz api görevini üstlenen controllerımız modül klasörü içerisinde bulunan controllers/api içerisinde yer alan "UsersControllers.php" dosyasıdır. Herhangi bir projemizde backend olarak görev almasını istediğimiz bu web service ile çeşitli isteklerle birlikte hedeflediğimiz database verilerine ulaşabilmekteyiz. Başlıca Get,Post,Put ve Delete http request metodlarından oluşan api yapıları bu modülde de bu şekilde kullanılmaktadır. Get metoduyla parametresiz atılan istekte tüm kullanıcıları bir json datası olarak döndüren api işlevi, kullanıcı id si verilerek gönderilen bir delete requesti ile de silme işlemini gerçekleştirir. Bilgisayarınıza indireceğiniz Postman uygulamasıyla bu yapının nasıl işlediğini görebilirsiniz.

![api](https://user-images.githubusercontent.com/41762847/50740721-bc9b3180-1203-11e9-9fa7-2690e5a8f121.png)


