#!/bin/bash
# @utor: Gabriel Cavalcante
# IFPB Redes Computadores
#
# Script para carregar arquivos alterados para conta git
# Funciona se o repositorio tiver sido clonado
# Caso ainda nao tenha clonado siga os passos abaixo:
#  - entra na pasta onde seja q fique o clone
#  - Comand: git clone "link-do-projeto"

git init
git add .
echo -n "Commit: "
read commit
git commit -m "$commit"
git push origin master
