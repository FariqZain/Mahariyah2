import cv2
import mediapipe as mp
import numpy as np
import PoseModule as pm
#from playsound import playsound
import smbus2


cap = cv2.VideoCapture('C:\\Users\\Acer\\pshup\\4884.mp4')
#cap = cv2.VideoCapture(0)
#cap.set(cv2.CAP_PROP_FRAME_WIDTH, 640)
#cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 640)
detector = pm.poseDetector()
count = 0
direction = 0
form = 0
feedback = "Fix Form"

# Konfigurasi I2C
address = 0x08  # Ganti dengan alamat I2C ESP32 Anda
bus = smbus2.SMBus(1)  # Biasanya bus I2C pada Raspberry Pi adalah 1

# Fungsi untuk mengirim data ke ESP32
def kirim_data(data):
    bus.write_byte(address, data)

while cap.isOpened():
    ret, img = cap.read() #640 x 480
    #Determine dimensions of video - Help with creation of box in Line 43
    width  = cap.get(3)  # float `width`
    height = cap.get(4)  # float `height`
    # print(width, height)
    
    img = detector.findPose(img, False)
    lmList = detector.findPosition(img, False)
    # print(lmList)
    if len(lmList) != 0:
        elbow = detector.findAngle(img, 11, 13, 15)
        shoulder = detector.findAngle(img, 13, 11, 23)
        hip = detector.findAngle(img, 11, 23,25)
        
        #Percentage of success of pushup
        per = np.interp(elbow, (90, 160), (0, 100))
        
        #Bar to show Pushup progress
        bar = np.interp(elbow, (90, 160), (380, 50))

        #Check to ensure right form before starting the program
        if elbow > 160 and shoulder > 40 and hip > 160:
            form = 1
    
        #Check for full range of motion for the pushup
        if form == 1:
            if per == 0:
                if elbow <= 90 and hip > 160:
                    feedback = "Down"
                    #cv2.putText(img, str(''), (500, 70 ), cv2.FONT_HERSHEY_PLAIN, 2, (0, 255, 0), 2)
                    if direction == 0:
                        count += 0.5
                        direction = 1
                else:
                    feedback = "Fix Form"
                    #cv2.putText(img, str('Fix Form'), (500, 70 ), cv2.FONT_HERSHEY_PLAIN, 2, (0, 255, 0), 2)

            if per == 100:
                if elbow > 160 and shoulder > 40 and hip > 160:
                    feedback = "Up"
                    #cv2.putText(img, str(''), (500, 70 ), cv2.FONT_HERSHEY_PLAIN, 2, (0, 255, 0), 2)
                    if direction == 1:
                        count += 0.5
                        direction = 0
                else:
                    feedback = "Fix Form"
                    #playsound('notif.mp3')

                    #cv2.putText(img, str('Fix Form'), (500, 70 ), cv2.FONT_HERSHEY_PLAIN, 2, (0, 255, 0), 2)
                        # form = 0
                
                    
        kirim_data(count)
        #print(count)
        """
        #Draw Bar
        if form == 1:
            cv2.rectangle(img, (580, 50), (600, 380), (0, 255, 0), 3)
            cv2.rectangle(img, (580, int(bar)), (600, 380), (0, 255, 0), cv2.FILLED)
            cv2.putText(img, f'{int(per)}%', (565, 430), cv2.FONT_HERSHEY_PLAIN, 2,
                        (255, 0, 0), 2) """


        #Pushup counter
        #cv2.rectangle(img, (0, 380), (100, 480), (0, 255, 0), cv2.FILLED)
        cv2.rectangle(img, (500, 0), (640, 70), (255, 255, 255), cv2.FILLED)
        cv2.putText(img, str(int(count)), (550, 40), cv2.FONT_HERSHEY_PLAIN, 3, (0, 0, 0), 3)
        
        #Feedback 
        cv2.putText(img, feedback, (500, 70 ), cv2.FONT_HERSHEY_PLAIN, 2, (0, 0, 0), 2)

        
    resized_frame = cv2.resize(img, (640, 480))    
    cv2.imshow('Pushup counter', img)
    if cv2.waitKey(10) & 0xFF == ord('q'):
        break
        
cap.release()
cv2.destroyAllWindows()