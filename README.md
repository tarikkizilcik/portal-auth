# portal-auth

portal-auth modülü http://portal.kouosl/ sitesinde yer alan modülümüzün giriş kısmını oluşturan kısımdır.
http://portal.kouosl/admin/login/auth adresi ile erişilen backend kısmında kullanıcılara yetki alıp/verme, görevlendirme vb. gibi yetkilerin tutulduğu kısımdır.
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
https://github.com/tarikkizilcik/portal.git 
```

adresinde ki portal repositorysi clone ya da download edilerek ilgili portal klasöründeki gerekli değişiklikler update edilmelidir. Verilen adresten temin edilen portal klasörünün içersinde vendor dizini bulunmamaktadır. Kurulumun ileri aşamalarında dizine eklenecek dosyalardan bahsedilecektir.  


### Modül ekleme ve hazır hale getirme

Kullanılmak istenen login modülünü ve ana projeye ait fork edilip değiştirilmiş theme modülünün kullanılabilir hale getirilmesi için portal ana dizininde bulunan "composer.json" dosyası düzenlenilerek "repositories" dizisi içerisine bu iki modül resimde gösterildiği gibi url adresleriyle beraber eklenmelidir.


```
 "repositories": [
        ...
	    {
            "type": "vcs",
            "url": "https://github.com/tarikkizilcik/portal-login.git"
        },
        {
            "type": "vcs",
            "url": "https://github.com/tarikkizilcik/portal-theme.git"
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


Modülün çalışmak için ihityaç duyduğu iki database tablosu bulunmaktadır. Bunlardan 1. olan user tablosu sistem girişinin de kullandığı bir tablo olduğundandolayı hazır halde phpMyAdmin de bulunmaktadır. Yapmamız gereken 2. tabloyu da modülü kullanmaya başlamadan önce oluşturmaktır. bunun için modül dizini altında migrations klasörü içinde bulunan "m181226_222711_auth.php" adlı migration dosyasını portal ana dizininde yer alan migrations klasörüne taşımak ve portal dizini altında çalışan konsol ekranında,
```
 php yii migrate
```
komutunu çalıştırmaktır. Gelen soruya evet denilerek ilgili tablonun database tarafında oluşması sağlanır.
### Modül kullanımı 
```
http://portal.kouosl/login/auth
```
adresi ile anasayfa gözüküyor olması gerekir.

login butonuyla devam edildiği taktirde karşımıza gelen login ekranında kayıtlı olan kullanıcı bilgileriyle giriş sağlanılabilmektedir.

![login](https://user-images.githubusercontent.com/41762847/50738173-3d493600-11e2-11e9-9f15-e7bc8a074c61.png)

eğer sisteme yeni bir kullanıcı ile giriş yapılmak isteniyorsa sistemden loguot olduktan sonra direkt login butonu üzerindeki sign up bağlantısından ya da anasayfadaki signup butonundan kayıt penceresine erişilebilir.

![signup](https://user-images.githubusercontent.com/41762847/50738261-f14ac100-11e2-11e9-9c6a-70998cfa639f.png)

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
    user/user-create
    user/user-delete
    user/user-update
```
bilgisi bize diğer metodları listelemektedir. Burada index default olarak kullanıcı sayısı, user metodu id si verilen bir kulanıcı listelemeyi,user-batch metodu kullanıcı grubu eklemeyi,user-create metodu yeni bir kullanıcı eklemeyi, user-delete le kullanıcı silmeyi ve user-update ile de id si verilen kullanıcıyı güncellemeyi yapabilmekteyiz.
