using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;


namespace sinema_otomasyon
{
    public partial class Form8 : Form
    {
        public Form8()
        {
            InitializeComponent();
        }
        SqlConnection baglan = new SqlConnection("server=DESKTOP-EOMOPV6\\SQLEXPRESS; Initial Catalog=sinema_otomasyon;Integrated Security=SSPI");
        int sayac = 0;

        private void Form8_Load(object sender, EventArgs e)
        {
           
        }
        // Dolu koltukları getirme işlemi
        private void VeriTabaniDoluKoltuklar()
        {
            baglan.Open();
            SqlCommand cmd = new SqlCommand("SELECT * FROM bilet", baglan);
            cmd.Parameters.AddWithValue("@film_adi", textBox4.Text);
            cmd.Parameters.AddWithValue("@seans_saat", textBox2.Text);
            cmd.Parameters.AddWithValue("@salon_adi", textBox3.Text);
            cmd.Parameters.AddWithValue("@koltuk_no", textBox5.Text);
            cmd.Parameters.AddWithValue("@koltuk_durum", "dolu");
            SqlDataReader dr = cmd.ExecuteReader();
            while (dr.Read())
            {
                foreach (Control item in panel1.Controls)
                {
                    if (item is Button)
                    {
                        if (dr["koltuk_no"].ToString() == item.Text && dr["film_adi"].ToString() == textBox4.Text && dr["seans_saat"].ToString() == textBox2.Text && dr["salon_adi"].ToString() == textBox3.Text)
                        {
                            item.BackColor = Color.Red;
                        }
                    }
                }
            }
            baglan.Close();
        }
        //Koltukların durumları değiştiğinde renklendirme işlemi
        private void YenidenRenklendir()
        {
            foreach (Control item in panel1.Controls)
            {
                if (item is Button)
                {
                    item.BackColor = Color.Lime;
                }
            }
        }
        // Koltuk oluşturma ve boş olan koltukları gösterme
        private void Bos_Koltuklar()
        {
            sayac = 1;
            for (int i = 0; i < 5; i++)
            {
                for (int j = 0; j < 5; j++)
                {
                    Button btn = new Button();
                    btn.Size = new Size(65, 65);
                    btn.Location = new Point(j * 60 + 20, i * 60 + 20);
                    btn.Name = sayac.ToString();
                    btn.Text = sayac.ToString();
                    if (j == 5)
                    {
                        continue;
                    }
                    sayac++;
                    this.panel1.Controls.Add(btn);
                    btn.Click += Btn_Click;
                }

            }
        }
        //Koltuk İptal İşlemi
        void Koltukİptal()
        {
            foreach (Control item in panel1.Controls)
            {
                if (item is Button)
                {
                    if (item.BackColor == Color.Red)
                    {
                        textBox6.Text = item.Text;
                     }
                }

            }
            MessageBox.Show("Seçilen koltuk iptal edildi!");
            textBox6.Text = "";
        }

        //Koltuğa tıklandığında sarıya dönme ve koltuk no kısmına yazma işlemi
        private void Btn_Click(object sender, EventArgs e)
        {
            Button b = (Button)sender;
            if (b.BackColor == Color.Lime)
            {
                textBox5.Text = b.Text;
                b.BackColor = Color.Yellow;



            }
            else if (b.BackColor == Color.Red)
            {
                textBox6.Text = b.Text;
            }
        }
        // Bilet Kesme Fonksiyonu
        void BiletKes()
        {

            SqlConnection baglan = new SqlConnection("server=DESKTOP-EOMOPV6\\SQLEXPRESS; Initial Catalog=sinema_otomasyon;Integrated Security=SSPI");
            baglan.Open();
            string sorgu = "INSERT INTO bilet(film_adi,bilet_isim,seans_saat,seans_tarih,salon_adi,musteri_tipi,koltuk_no) VALUES(@film_adi,@bilet_isim,@seans_saat,@seans_tarih,@salon_adi,@musteri_tipi,@koltuk_no)";
            SqlCommand cmd = new SqlCommand(sorgu, baglan);
            cmd.Parameters.AddWithValue("@film_adi", textBox4.Text);
            cmd.Parameters.AddWithValue("@bilet_isim", textBox1.Text);
            cmd.Parameters.AddWithValue("@seans_saat", textBox2.Text);
            cmd.Parameters.AddWithValue("@seans_tarih", dateTimePicker1.Value);
            cmd.Parameters.AddWithValue("@salon_adi", textBox3.Text);
            string musteri_tipi = "";
            if (radioButton1.Checked)
            {
                musteri_tipi = radioButton1.Text;
            }
            else if (radioButton2.Checked)
            {
                musteri_tipi = radioButton2.Text;
            }
            cmd.Parameters.AddWithValue("@musteri_tipi", musteri_tipi);
            cmd.Parameters.AddWithValue("@koltuk_no", textBox5.Text);


            cmd.ExecuteNonQuery();
            baglan.Close();
        }
        
        private void Form8_Load_1(object sender, EventArgs e)
        {
            Bos_Koltuklar();
            YenidenRenklendir();
            VeriTabaniDoluKoltuklar();
        }
        //Koltuk iptal etme işlemini gerçekleştiren ve tekrardan boş olarak gözükmesini sağlaayn işlem
        private void button2_Click_1(object sender, EventArgs e)
        {
            if (textBox6.Text != "")
            {
                string sorgu = "DELETE FROM bilet WHERE film_adi=@film_adi AND seans_saat=@seans_saat AND salon_adi=@salon_adi AND koltuk_no=@koltuk_no  ";
                SqlCommand cmd = new SqlCommand(sorgu, baglan);
                cmd.Parameters.AddWithValue("@film_adi", textBox4.Text);
                cmd.Parameters.AddWithValue("@seans_saat", textBox2.Text);
                cmd.Parameters.AddWithValue("@salon_adi", textBox3.Text);
                cmd.Parameters.AddWithValue("@koltuk_no", textBox6.Text);
                baglan.Open();
                cmd.ExecuteNonQuery();
                baglan.Close();
                textBox6.Text = "";
                YenidenRenklendir();
                VeriTabaniDoluKoltuklar();
                Koltukİptal();
            }
            else
            {
                MessageBox.Show("Koltuk Seçilmedi!");
            }
        }
        // Bileti alan kişinin adı ve koltuk alanlarının kontrolü
        private void button1_Click_1(object sender, EventArgs e)
        {
            if (textBox1.Text != "" && textBox5.Text != "")
            {
                BiletKes();
                MessageBox.Show("Bilet Satıldı!", "Uyarı");
                textBox1.Text = "";
            }
            else
            {
                MessageBox.Show("Koltuk Seçilmedi!", "Uyarı");
            }
        }
    }
}
