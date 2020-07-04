<?php

namespace Nuclear\system\view;

class mimes{

    private $mimes = [
        '.html' => 'text/html',
        '.json' => 'application/json',
        '.xml' => 'application/xml',
        '.rss' => 'application/rss+xml',
        '.ai' => 'application/postscript',
        '.bcpio' => 'application/x-bcpio',
        '.bin' => 'application/octet-stream',
        '.ccad' => 'application/clariscad',
        '.cdf' => 'application/x-netcdf',
        '.class' => 'application/octet-stream',
        '.cpio' => 'application/x-cpio',
        '.cpt' => 'application/mac-compactpro',
        '.csh' => 'application/x-csh',
        '.csv' => 'text/csv',
        '.dcr' => 'application/x-director',
        '.dir' => 'application/x-director',
        '.dms' => 'application/octet-stream',
        '.doc' => 'application/msword',
        '.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        '.drw' => 'application/drafting',
        '.dvi' => 'application/x-dvi',
        '.dwg' => 'application/acad',
        '.dxf' => 'application/dxf',
        '.dxr' => 'application/x-director',
        '.eot' => 'application/vnd.ms-fontobject',
        '.eps' => 'application/postscript',
        '.exe' => 'application/octet-stream',
        '.ez' => 'application/andrew-inset',
        '.flv' => 'video/x-flv',
        '.gtar' => 'application/x-gtar',
        '.gz' => 'application/x-gzip',
        '.bz2' => 'application/x-bzip',
        '.7z' => 'application/x-7z-compressed',
        '.hdf' => 'application/x-hdf',
        '.hqx' => 'application/mac-binhex40',
        '.ico' => 'image/x-icon',
        '.ips' => 'application/x-ipscript',
        '.ipx' => 'application/x-ipix',
        '.js' => 'application/javascript',
        '.jsonapi' => 'application/vnd.api+json',
        '.latex' => 'application/x-latex',
        '.lha' => 'application/octet-stream',
        '.lsp' => 'application/x-lisp',
        '.lzh' => 'application/octet-stream',
        '.man' => 'application/x-troff-man',
        '.me' => 'application/x-troff-me',
        '.mif' => 'application/vnd.mif',
        '.ms' => 'application/x-troff-ms',
        '.nc' => 'application/x-netcdf',
        '.oda' => 'application/oda',
        '.otf' => 'font/otf',
        '.pdf' => 'application/pdf',
        '.pgn' => 'application/x-chess-pgn',
        '.pot' => 'application/vnd.ms-powerpoint',
        '.pps' => 'application/vnd.ms-powerpoint',
        '.ppt' => 'application/vnd.ms-powerpoint',
        '.pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        '.ppz' => 'application/vnd.ms-powerpoint',
        '.pre' => 'application/x-freelance',
        '.prt' => 'application/pro_eng',
        '.ps' => 'application/postscript',
        '.roff' => 'application/x-troff',
        '.scm' => 'application/x-lotusscreencam',
        '.set' => 'application/set',
        '.sh' => 'application/x-sh',
        '.shar' => 'application/x-shar',
        '.sit' => 'application/x-stuffit',
        '.skd' => 'application/x-koan',
        '.skm' => 'application/x-koan',
        '.skp' => 'application/x-koan',
        '.skt' => 'application/x-koan',
        '.smi' => 'application/smil',
        '.smil' => 'application/smil',
        '.sol' => 'application/solids',
        '.spl' => 'application/x-futuresplash',
        '.src' => 'application/x-wais-source',
        '.step' => 'application/STEP',
        '.stl' => 'application/SLA',
        '.stp' => 'application/STEP',
        '.sv4cpio' => 'application/x-sv4cpio',
        '.sv4crc' => 'application/x-sv4crc',
        '.svg' => 'image/svg+xml',
        '.svgz' => 'image/svg+xml',
        '.swf' => 'application/x-shockwave-flash',
        '.t' => 'application/x-troff',
        '.tar' => 'application/x-tar',
        '.tcl' => 'application/x-tcl',
        '.tex' => 'application/x-tex',
        '.texi' => 'application/x-texinfo',
        '.texinfo' => 'application/x-texinfo',
        '.tr' => 'application/x-troff',
        '.tsp' => 'application/dsptype',
        '.ttc' => 'font/ttf',
        '.ttf' => 'font/ttf',
        '.unv' => 'application/i-deas',
        '.ustar' => 'application/x-ustar',
        '.vcd' => 'application/x-cdlink',
        '.vda' => 'application/vda',
        '.xlc' => 'application/vnd.ms-excel',
        '.xll' => 'application/vnd.ms-excel',
        '.xlm' => 'application/vnd.ms-excel',
        '.xls' => 'application/vnd.ms-excel',
        '.xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        '.xlw' => 'application/vnd.ms-excel',
        '.zip' => 'application/zip',
        '.aif' => 'audio/x-aiff',
        '.aifc' => 'audio/x-aiff',
        '.aiff' => 'audio/x-aiff',
        '.au' => 'audio/basic',
        '.kar' => 'audio/midi',
        '.mid' => 'audio/midi',
        '.midi' => 'audio/midi',
        '.mp2' => 'audio/mpeg',
        '.mp3' => 'audio/mpeg',
        '.mpga' => 'audio/mpeg',
        '.ogg' => 'audio/ogg',
        '.oga' => 'audio/ogg',
        '.spx' => 'audio/ogg',
        '.ra' => 'audio/x-realaudio',
        '.ram' => 'audio/x-pn-realaudio',
        '.rm' => 'audio/x-pn-realaudio',
        '.rpm' => 'audio/x-pn-realaudio-plugin',
        '.snd' => 'audio/basic',
        '.tsi' => 'audio/TSP-audio',
        '.wav' => 'audio/x-wav',
        '.aac' => 'audio/aac',
        '.asc' => 'text/plain',
        '.c' => 'text/plain',
        '.cc' => 'text/plain',
        '.css' => 'text/css; charset: UTF-8',
        '.etx' => 'text/x-setext',
        '.f' => 'text/plain',
        '.f90' => 'text/plain',
        '.h' => 'text/plain',
        '.hh' => 'text/plain',
        '.htm' => 'text/html',
        '.ics' => 'text/calendar',
        '.m' => 'text/plain',
        '.rtf' => 'text/rtf',
        '.rtx' => 'text/richtext',
        '.sgm' => 'text/sgml',
        '.sgml' => 'text/sgml',
        '.tsv' => 'text/tab-separated-values',
        '.tpl' => 'text/template',
        '.txt' => 'text/plain',
        '.text' => 'text/plain',
        '.avi' => 'video/x-msvideo',
        '.fli' => 'video/x-fli',
        '.mov' => 'video/quicktime',
        '.movie' => 'video/x-sgi-movie',
        '.mpe' => 'video/mpeg',
        '.mpeg' => 'video/mpeg',
        '.mpg' => 'video/mpeg',
        '.qt' => 'video/quicktime',
        '.viv' => 'video/vnd.vivo',
        '.vivo' => 'video/vnd.vivo',
        '.ogv' => 'video/ogg',
        '.webm' => 'video/webm',
        '.mp4' => 'video/mp4',
        '.m4v' => 'video/mp4',
        '.f4v' => 'video/mp4',
        '.f4p' => 'video/mp4',
        '.m4a' => 'audio/mp4',
        '.f4a' => 'audio/mp4',
        '.f4b' => 'audio/mp4',
        '.gif' => 'image/gif',
        '.ief' => 'image/ief',
        '.jpg' => 'image/jpeg',
        '.jpeg' => 'image/jpeg',
        '.jpe' => 'image/jpeg',
        '.pbm' => 'image/x-portable-bitmap',
        '.pgm' => 'image/x-portable-graymap',
        '.png' => 'image/png',
        '.pnm' => 'image/x-portable-anymap',
        '.ppm' => 'image/x-portable-pixmap',
        '.ras' => 'image/cmu-raster',
        '.rgb' => 'image/x-rgb',
        '.tif' => 'image/tiff',
        '.tiff' => 'image/tiff',
        '.xbm' => 'image/x-xbitmap',
        '.xpm' => 'image/x-xpixmap',
        '.xwd' => 'image/x-xwindowdump',
        '.ice' => 'x-conference/x-cooltalk',
        '.iges' => 'model/iges',
        '.igs' => 'model/iges',
        '.mesh' => 'model/mesh',
        '.msh' => 'model/mesh',
        '.silo' => 'model/mesh',
        '.vrml' => 'model/vrml',
        '.wrl' => 'model/vrml',
        '.mime' => 'www/mime',
        '.pdb' => 'chemical/x-pdb',
        '.xyz' => 'chemical/x-pdb',
        '.javascript' => 'application/javascript',
        '.form' => 'application/x-www-form-urlencoded',
        '.file' => 'multipart/form-data',
        '.xhtml' => 'application/xhtml',
        '.xhtml-mobile' => 'application/vnd.wap.xhtml+xml',
        '.atom' => 'application/atom+xml',
        '.amf' => 'application/x-amf',
        '.wap' => 'text/vnd.wap.wml',
        '.wml' => 'text/vnd.wap.wml',
        '.wmlscript' => 'text/vnd.wap.wmlscript',
        '.wbmp' => 'image/vnd.wap.wbmp',
        '.woff' => 'application/x-font-woff',
        '.webp' => 'image/webp',
        '.appcache' => 'text/cache-manifest',
        '.manifest' => 'text/cache-manifest',
        '.htc' => 'text/x-component',
        '.rdf' => 'application/xml',
        '.crx' => 'application/x-chrome-extension',
        '.oex' => 'application/x-opera-extension',
        '.xpi' => 'application/x-xpinstall',
        '.safariextz' => 'application/octet-stream',
        '.webapp' => 'application/x-web-app-manifest+json',
        '.vcf' => 'text/x-vcard',
        '.vtt' => 'text/vtt',
        '.mkv' => 'video/x-matroska',
        '.pkpass' => 'application/vnd.apple.pkpass',
        '.ajax' => 'text/html'
    ];

    /**
     * Get the value of mimes
     */ 
    public function get($ext)
    {
        if(isset($this->mimes[$ext]))
            return $this->mimes[$ext];
        return null;
    }

    /**
     * Set the value of mimes
     *
     * @return  self
     */ 
    public function set($ext,$mime)
    {
        if(isset($ext) && isset($mime)){
            if(array_key_exists($ext,$this->mimes))
                $this->mimes[$ext] = $mime;
        }
        return $this;
    }
}


?>