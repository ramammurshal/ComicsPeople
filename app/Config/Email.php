<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    /**
     * @var string
     */
    // ini ditambahin, saran jangan email asli
    public $fromEmail = "rmurshal2@gmail.com";

    /**
     * @var string
     */
    // ini kita tambahin
    public $fromName = "Rama Muhammad Murshal";

    /**
     * @var string
     */
    public $recipients;

    /**
     * The "user agent"
     *
     * @var string
     */
    public $userAgent = 'CodeIgniter';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     *
     * @var string
     */

    //  ganti jadi smtp
    public $protocol = 'smtp';

    /**
     * The server path to Sendmail.
     *
     * @var string
     */
    public $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Server Address
     *
     * @var string
     */

    // ganti jadi seperti itu
    public $SMTPHost = "smtp.gmail.com";

    /**
     * SMTP Username
     *
     * @var string
     */

    //  masukkan dengan email yang sama dengan diatas
    public $SMTPUser = "rmurshal2@gmail.com";

    /**
     * SMTP Password
     *
     * @var string
     */

    //  password harus sesuai dengan email
    public $SMTPPass = "ramzzzz41271101";

    /**
     * SMTP Port
     *
     * @var int
     */

    //  ini ganti jadi 465
    public $SMTPPort = 465;

    /**
     * SMTP Timeout (in seconds)
     *
     * @var int
     */

    //  ganti jadi 1 menit, apabila tidak ada respon, maka tampilkan error
    public $SMTPTimeout = 60;

    /**
     * Enable persistent SMTP connections
     *
     * @var bool
     */
    public $SMTPKeepAlive = false;

    /**
     * SMTP Encryption. Either tls or ssl
     *
     * @var string
     */

    //  ganti jadi ssl
    public $SMTPCrypto = 'ssl';

    /**
     * Enable word-wrap
     *
     * @var bool
     */
    public $wordWrap = true;

    /**
     * Character count to wrap at
     *
     * @var int
     */
    public $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     *
     * @var string
     */

    //  mailType ganti jadi html
    public $mailType = 'html';

    // terakhir ganti less secure app pada email jadi on agar jadi kurang aman

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     *
     * @var string
     */
    public $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     *
     * @var bool
     */
    public $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     *
     * @var int
     */
    public $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     *
     * @var string
     */
    public $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     *
     * @var string
     */
    public $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     *
     * @var bool
     */
    public $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     *
     * @var int
     */
    public $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     *
     * @var bool
     */
    public $DSN = false;
}
