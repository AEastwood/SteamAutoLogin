namespace SteamLogin
{
    partial class ScreenManager
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.screenL = new System.Windows.Forms.Panel();
            this.screenM = new System.Windows.Forms.Panel();
            this.screenR = new System.Windows.Forms.Panel();
            this.SuspendLayout();
            // 
            // screenL
            // 
            this.screenL.BackColor = System.Drawing.SystemColors.ControlDark;
            this.screenL.Cursor = System.Windows.Forms.Cursors.Hand;
            this.screenL.Location = new System.Drawing.Point(12, 12);
            this.screenL.Name = "screenL";
            this.screenL.Size = new System.Drawing.Size(384, 216);
            this.screenL.TabIndex = 0;
            this.screenL.Click += new System.EventHandler(this.screenL_Click);
            // 
            // screenM
            // 
            this.screenM.BackColor = System.Drawing.SystemColors.ControlDark;
            this.screenM.Cursor = System.Windows.Forms.Cursors.Hand;
            this.screenM.Location = new System.Drawing.Point(402, 12);
            this.screenM.Name = "screenM";
            this.screenM.Size = new System.Drawing.Size(384, 216);
            this.screenM.TabIndex = 1;
            this.screenM.Click += new System.EventHandler(this.screenM_Click);
            // 
            // screenR
            // 
            this.screenR.BackColor = System.Drawing.SystemColors.ControlDark;
            this.screenR.Cursor = System.Windows.Forms.Cursors.Hand;
            this.screenR.Location = new System.Drawing.Point(792, 12);
            this.screenR.Name = "screenR";
            this.screenR.Size = new System.Drawing.Size(384, 216);
            this.screenR.TabIndex = 1;
            this.screenR.Click += new System.EventHandler(this.screenR_Click);
            // 
            // ScreenManager
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.Control;
            this.ClientSize = new System.Drawing.Size(1190, 242);
            this.Controls.Add(this.screenR);
            this.Controls.Add(this.screenM);
            this.Controls.Add(this.screenL);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "ScreenManager";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "ScreenManager";
            this.TopMost = true;
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Panel screenL;
        private System.Windows.Forms.Panel screenM;
        private System.Windows.Forms.Panel screenR;
    }
}