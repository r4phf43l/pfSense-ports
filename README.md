# pfSense-ports

<!---Esses são exemplos. Veja https://shields.io para outras pessoas ou para personalizar este conjunto de escudos. Você pode querer incluir dependências, status do projeto e informações de licença aqui--->

![GitHub repo size](https://img.shields.io/github/repo-size/r4phf43l/pfSense-ports)
![GitHub language count](https://img.shields.io/github/languages/count/iuricode/README-template?style=for-the-badge)
![GitHub forks](https://img.shields.io/github/forks/iuricode/README-template?style=for-the-badge)
![Bitbucket open issues](https://img.shields.io/bitbucket/issues/iuricode/README-template?style=for-the-badge)
![Bitbucket open pull requests](https://img.shields.io/bitbucket/pr-raw/iuricode/README-template?style=for-the-badge)

### Ajustes e melhorias

O projeto é feito sob demanda pessoal, os pacotes são disponibilizados sem previsão de ajutes/melhorias.

## 💻 Pré-requisitos
Os pacotes são voltados para o `pfSense 2.7 (beta) e pfSense + 23.05-RELEASE`.

Antes de começar, você pode ter que instalar alguns pacotes adicionais:
* Você pode ter que instalar libgd: `pkg install libgd`
* Você pode ter que instalar sarg: `pkg add http://pkg.freebsd.org/FreeBSD:14:amd64/latest/All/sarg-2.4.0_2.pkg`

## 🚀 Instalando <nome_do_projeto>

Para instalar o pacotes, siga estas etapas:

Acesse o pfSense via SSH ou tiretamente via console
```
fetch https://raw.githubusercontent.com/r4phf43l/pfSense-ports/main/<package-name>.pkg
pkg add <packet-name>
```

## 📫 Para criar seus próprios ports
1. Descompacteo pacote original
2. `xz -d <package-name>.txz`, ignore se o pacote for pkg
3. `tar xvf <package-name>.tar` ou `tar xvf <package-name>.pkg`
4. Edite o arquivo +MANIFEST `nano +MANIFEST`
5. `pkg create -M ./+MANIFEST`

Como alternativa, consulte a documentação do GitHub em [como criar uma solicitação pull](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request).

## 🤝 Sobre o projeto

Os pacotes são forks do trabalho de Marcello Coutinho (https://github.com/marcelloc).

[⬆ Voltar ao topo](#pfSense-ports)<br>
