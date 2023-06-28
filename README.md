# pfSense-ports

![GitHub repo size](https://img.shields.io/github/repo-size/r4phf43l/pfSense-ports)
![GitHub language count](https://img.shields.io/github/languages/count/r4phf43l/pfSense-ports)
![GitHub forks](https://img.shields.io/github/forks/r4phf43l/pfSense-ports)
![GitHub issues](https://img.shields.io/github/issues/r4phf43l/pfSense-ports)
![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/r4phf43l/pfSense-ports)

### Ajustes e melhorias

O projeto é feito sob demanda pessoal, os pacotes são disponibilizados sem previsão de ajustes/melhorias.

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

## 🤝 Sobre o projeto

Os pacotes são forks do trabalho de Marcello Coutinho (https://github.com/marcelloc).

[⬆ Voltar ao topo](#pfSense-ports)<br>
