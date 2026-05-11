<h2>Bize Ulaşın</h2>
        
        <form id="contactForm" method="post" action="server.php">
            <fieldset>
                <legend>Kişisel Bilgiler</legend>
                <div class="cont_box">
                <label for="name">Ad Soyad</label><b></b>
                <input type="text" id="Name" placeholder="Adınızı ve Soyadınızı giriniz..."><br><br>
                    <div class="error" id="n_error"></div>
                </div>
            </fieldset>
        
            <fieldset>
                <legend>İletişim Tercihi</legend>
                <div class="pref_button">
                    <button type="button" name="prefCont" value="e-mail" >E-posta</button>
                    <button type="button" name="prefCont" value="phone" >Telefon</button>
                </div>
                    <div class="error" id="c_error" ></div>
                <div class="pref_cont" id="e-mail_box">
                    <label for="email">E-posta Adresi</label>
                    <input type="email" id="email" placeholder="ornek@mail.com"><br>
                        <div class="error" id="e_error"></div>
                </div>
                <div class="pref_cont" id="phone_box">
                    <label for="phone">Telefon Numarası</label>
                    <input type="tel" id="phone" placeholder="5XXXXXXXXX">
                        <div class="error" id="p_error"></div>
                </div>
            </fieldset>
            <fieldset>
                <div class="cont_box">
                    <label for="message">Mesajınız</label><br>
                    <textarea id="message" rows="4" placeholder="Mesajınızı yazınız..."></textarea>
                </div>
            </fieldset>

            <button type="submit" name="contact" value="contact_form">Gönder</button>
        </form>