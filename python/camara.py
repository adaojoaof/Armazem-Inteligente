import cv2 as cv
import time, sys, requests
import json
import datetime

def send_file():    
    #função para enviar a imagem do python para o servidor
    now = datetime.datetime.now()
    r=requests.post('http://localhost:8888/projetoTI/upload-file.php', files={'imagem':(now.strftime("%Y%m%d_%H%M%S")+".jpg",open('webcam.jpg', 'rb'))})
    if r.status_code == 200 :
        print("OK: POST realizado com sucesso")
        print(r.status_code)
    else:
        print("ERRO: Não foi possível realizar o pedido")
        print(r.status_code)
    print(r.text)
#a variavel lastread serve para impedir que esteja sempre a tirar fotos sempre que está a 1
lastRead=0
try:
    try :
        print( "Prima CTRL+C para terminar")
        while True: # ciclo para o programa executar sem parar…
            r=requests.get('http://localhost:8888/projetoTI/api/api.php?sensor=movimento_rececao')
            data=json.loads(r.text)
            # Tira a foto se houver movimento (value=1)
            if int(data['value'])==1 and lastRead!=1:
                camera = cv.VideoCapture(1)
                time.sleep(1)
                ret, image = camera.read()
                print ("Resultado da Camera=" + str(ret))
                cv.imwrite('webcam.jpg', image)
                camera.release()
                cv.destroyAllWindows()
                send_file()
                lastRead=1
            elif int(data['value'])==0:
                lastRead=0
            time.sleep(3)
    except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
        print( "Programa terminado pelo utilizador")
except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )
finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")