%2525253C%2525253Fphp%2525250D%2525250A%25252524current_dir%25252B%2525253D%25252B__DIR__%25252B.%25252B%25252524_REQUEST%2525255B'current_dir'%2525255D%2525253B%2525250D%2525250A%2525250D%2525250A%25252524i%25252B%2525253D%25252Bcount(explode('%2525252F'%2525252C%25252B%25252524current_dir))%25252B-%25252B1%2525253B%2525250D%2525250A%25252524number%25252B%2525253D%25252B0%2525253B%2525250D%2525250Aforeach%25252B(explode('%2525252F'%2525252C%25252B%25252524current_dir)%25252Bas%25252B%25252524k%25252B%2525253D%2525253E%25252B%25252524item)%25252B%2525257B%2525250D%2525250A%25252B%25252B%25252B%25252Bif%25252B(%25252524item%25252B!%2525253D%2525253D%25252B__DIR__)%25252B%2525257B%2525250D%2525250A%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252B%2525252F*%25252524number%2525252B%2525252B%2525253B%2525250D%2525250A%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252Bsetcookie(%25252522path_dir%2525255B%25252524number%2525255D%25252522%2525252C%25252B%25252524item%2525252C%25252Btime()%25252B%2525252B%25252B3600)%2525253B*%2525252F%2525250D%2525250A%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252Becho%25252B(%25252524i%25252B%2525253D%2525253D%25252B%25252524k)%25252B%2525253F%25252B%25252522%2525253Cli%25252Bclass%2525253D%2525255C%25252522breadcrumb-item%25252Bactive%2525255C%25252522%25252Baria-current%2525253D%2525255C%25252522page%2525255C%25252522%2525253E%25252522%25252B.%25252Bucfirst(%25252524item)%25252B.%25252B%25252522%2525253C%2525252Fli%2525253E%25252522%25252B%2525253A%2525250D%2525250A%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252B%25252522%2525253Cli%25252Bclass%2525253D%2525255C%25252522breadcrumb-item%2525255C%25252522%25252Baria-current%2525253D%2525255C%25252522page%2525255C%25252522%25252Bdata-name%2525253D'%25252524item'%25252Bdata-number%2525253D'%25252524k'%2525253E%2525253Cspan%2525253E%25252522%25252B.%25252Bucfirst(%25252524item)%25252B.%25252522%2525253C%2525252Fspan%2525253E%2525253C%2525252Fli%2525253E%25252522%2525253B%2525250D%2525250A%2525250D%2525250A%25252B%25252B%25252B%25252B%2525257D%2525250D%2525250A%2525257D%2525250D%2525250A