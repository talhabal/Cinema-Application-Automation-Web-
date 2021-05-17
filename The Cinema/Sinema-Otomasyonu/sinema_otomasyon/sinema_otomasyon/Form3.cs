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
using System.IO;

namespace sinema_otomasyon
{
    public partial class Form3 : Form
    {
        veritabani yeni = new veritabani();
        SqlConnection baglan = new SqlConnection("server=DESKTOP-EOMOPV6\\SQLEXPRESS; Initial Catalog=sinema_otomasyon;Integrated Security=SSPI");
        SqlCommand cmd = new SqlCommand();



        SqlDataReader dr;



        public Form3()
        {
            InitializeComponent();
        }





        private void Form3_Load(object sender, EventArgs e)
        {

            comboBox1.DataSource = yeni.film_kategori.ToList();
            comboBox2.DataSource = yeni.yonetmen.ToList();
            comboBox3.DataSource = yeni.yapimci.ToList();

            //Oyuncu Seçimi

            baglan.Open();
            cmd.Connection = baglan;
            cmd.CommandText = "SELECT * FROM oyuncu";
            dr = cmd.ExecuteReader();
            while (dr.Read())
            {
                checkedListBox1.Items.Add(dr["film_oyuncu"]);
            }
            baglan.Close();


        }



        private void button2_Click(object sender, EventArgs e)
        {
            this.Hide();
            Form2 frm2 = new Form2();
            frm2.ShowDialog();
        }
        string dosyaYolu;
        string dosyaAdi;
        private void button3_Click_1(object sender, EventArgs e)
        {
            OpenFileDialog dosya = new OpenFileDialog();
            dosya.Filter = "Resim Dosyası |*.jpg;*.nef;*.png |  Tüm Dosyalar |*.*";
            dosya.ShowDialog();
            dosyaYolu = dosya.FileName;
            pictureBox2.ImageLocation = dosyaYolu;
            dosyaAdi = Path.GetFileName(dosyaYolu); //Dosya adını alma
            textBox2.Text = dosyaYolu;
            textBox4.Text = dosyaAdi;
        }

        private void button1_Click_1(object sender, EventArgs e)
        {
            foreach (object item in checkedListBox1.CheckedItems)
            {
                string checkedItem = item.ToString();
                label8.Text = label8.Text + checkedItem + ",";
            }

            SqlConnection baglan = new SqlConnection("server=DESKTOP-EOMOPV6\\SQLEXPRESS; Initial Catalog=sinema_otomasyon;Integrated Security=SSPI");
            baglan.Open();
            SqlCommand cmd = new SqlCommand("insert into filmler(film_adi,film_turu,yonetmen_adi,yapimci_adi,film_oyuncu,film_tarih,film_resim,resim_php)values" + "(@film_adi,@film_turu,@yonetmen_adi,@yapimci_adi,@film_oyuncu,@film_tarih,@film_resim,@resim_php)", baglan);
            cmd.Parameters.AddWithValue("@film_adi", textBox1.Text);
            cmd.Parameters.AddWithValue("@film_turu", comboBox1.Text);
            cmd.Parameters.AddWithValue("@yonetmen_adi", comboBox2.Text);
            cmd.Parameters.AddWithValue("@yapimci_adi", comboBox3.Text);
            cmd.Parameters.AddWithValue("@film_oyuncu", label8.Text.ToString());
            cmd.Parameters.AddWithValue("@film_tarih", dateTimePicker1.Value.ToString());
            cmd.Parameters.AddWithValue("@film_resim", textBox2.Text);
            cmd.Parameters.AddWithValue("@resim_php", textBox4.Text);
            cmd.ExecuteNonQuery();
            baglan.Close();

            MessageBox.Show("Başarıyla Eklendi", "Bilgi");
            alansil();
        }

        private void alansil()
        {
            textBox1.Text = "";
            comboBox1.Text = "";
            comboBox2.Text = "";
            comboBox3.Text = "";
            textBox2.Text = "";
        }

       

        private void textBox3_TextChanged_1(object sender, EventArgs e)
        {
            int index = checkedListBox1.FindString(this.textBox3.Text);
            if (0 <= index)
            {
                checkedListBox1.SelectedIndex = index;

            }
            if (this.textBox3.Text.Trim() == "")
                checkedListBox1.SelectedIndex = -1;
        }
    }
}
