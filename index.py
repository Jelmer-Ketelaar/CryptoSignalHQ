import mysql.connector
import requests
import datetime
import re
from python_bitvavo_api.bitvavo import Bitvavo
from telegram.ext import Updater, MessageHandler, Filters

# Constants and configurations
TELEGRAM_API_TOKEN = '6274241270:AAHVg5Z0xdSWNebvqH2VIhIsbKKSuWbmQwc'
TELEGRAM_CHAT_ID = '-1001979084434'
DATABASE_CONFIG = {
    'host': "localhost",
    'user': "root",
    'password': "",
    'database': "cryptosignalhq"
}


def establish_db_connection():
    return mysql.connector.connect(**DATABASE_CONFIG)


def notify_telegram(notification):
    url = f'https://api.telegram.org/bot{TELEGRAM_API_TOKEN}/sendMessage'
    try:
        resp = requests.post(url, json={'chat_id': TELEGRAM_CHAT_ID, 'text': notification})
        print(resp.text)
    except Exception as exc:
        print(exc)


def db_operations(text):
    if 'nnnnnn' in text:
        db_conn = establish_db_connection()
        cursor = db_conn.cursor(buffered=True)
        email, api, secret, trade_percentage = re.findall(r'nnnnnn (\S+) (\S+) (\S+) (\S+)', text)[0]

        query = "INSERT INTO api (email, api, secret, tradePercentage) VALUES (%s, %s, %s, %s)"
        values = (email, api, secret, trade_percentage)
        cursor.execute(query, values)

        db_conn.commit()
        cursor.close()

        if 'kkkkkk' in text:
            db_conn = establish_db_connection()
            cursor = db_conn.cursor(buffered=True)
            email, api, secret = re.findall(r'kkkkkk (\S+) (\S+) (\S+)', text)[0]

            query = "INSERT INTO apielite (email, api, secret) VALUES (%s, %s, %s)"
            values = (email, api, secret)
            cursor.execute(query, values)

            db_conn.commit()
            cursor.close()


def place_order(text):
    if 'Pair:' in text:
        with establish_db_connection() as db_conn:
            cursor = db_conn.cursor(buffered=True)
            cursor.execute("SELECT * FROM api")
            user_list = cursor.fetchall()

            for user_data in user_list:
                try:
                    cursor.execute("SELECT * FROM api WHERE id = %s", [user_data[0]])
                    user = cursor.fetchone()
                    new_msg = text

                    if 'Pair' in new_msg:
                        symbol = re.search(r'Pair:(\S+)', new_msg).group(1).strip()
                        trade_percentage, api_key, secret_key, user_email = user[4], user[2], user[3], user[1]

                        bitvavo_config = {
                            'APIKEY': api_key,
                            'APISECRET': secret_key,
                            'RESTURL': 'https://api.bitvavo.com/v2',
                            'WSURL': 'wss://ws.bitvavo.com/v2/',
                            'ACCESSWINDOW': 10000,
                            'DEBUGGING': True
                        }
                        bitvavo_obj = Bitvavo(bitvavo_config)

                        for balance_data in bitvavo_obj.balance({}):
                            if 'EUR' == balance_data['symbol']:
                                eur_balance = balance_data['available']
                                try:
                                    print(balance_data)
                                    users_bought.append([api_key, secret_key, eur_balance, trade_percentage])
                                except Exception as exc:
                                    notify_telegram(f'{user_email}: {str(exc)}')
                                    continue
                                quote_amount = float(eur_balance) / 100 * float(trade_percentage)

                        try:
                            bitvavo_obj.placeOrder(symbol, 'buy', 'market', {'amountQuote': str(quote_amount)})
                            print('Success')
                        except Exception as exc:
                            print('Failed:', exc)
                except Exception as exc:
                    print('Error:', exc)


def manage_sales(text):
    if 'Winst Doel Behaald!' in message_text or 'Verlies Doel Geraakt!' in message_text:
        with get_db_connection() as mydb:
            mycursor = mydb.cursor(buffered=True)
            sql = "SELECT * FROM api"
            mycursor.execute(sql)
            users = mycursor.fetchall()
            for userC in users:
                time.sleep(1)
                sql = "SELECT pair FROM signals ORDER BY id DESC LIMIT 1"
                mycursor.execute(sql)
                lastPair = mycursor.fetchone()[0]
                lastAsset = lastPair.split("-EUR")[0]

                sqlu = "SELECT * FROM api WHERE id = %s"
                adru = [userC[0]]
                mycursor.execute(sqlu, adru)
                user = mycursor.fetchone()

                tradePercentage = user[4]  # standaart 50%
                api_key = user[2]
                secret_key = user[3]
                emailUser = user[1]

                bitvavo = Bitvavo({
                    'APIKEY': api_key,
                    'APISECRET': secret_key,
                    'RESTURL': 'https://api.bitvavo.com/v2',
                    'WSURL': 'wss://ws.bitvavo.com/v2/',
                    'ACCESSWINDOW': 10000,
                    'DEBUGGING': True
                })

                balance = bitvavo.balance({})
                try:
                    for bal in balance:
                        if lastAsset == bal['symbol']:
                            assBalance = bal['available']
                            print(bal)
                            usersSell.append([api_key, secret_key, assBalance, tradePercentage])
                except Exception as e:
                    continue
                time.sleep(1)
                try:
                    response = bitvavo.placeOrder(lastPair, 'sell', 'market', {'amount': str(assBalance)})
                    print('Gelukt')
                except Exception as e:
                    print('mislukt:', e)

                for geb in usersSell:
                    sql = "SELECT * FROM api WHERE id = %s"
                    adr = [geb[0]]
                    mycursor.execute(sql, adr)
                    user = mycursor.fetchone()
                    api_key = geb[0]
                    secret_key = geb[1]
                    vorigeBalance = geb[2]
                    tradePercentage = geb[3]

                    mycursor = mydb.cursor(buffered=True)
                    sql = "SELECT pair FROM signals ORDER BY id DESC LIMIT 1"
                    mycursor.execute(sql)
                    lastPair = mycursor.fetchone()[0]
                    lastAsset = lastPair.split("-EUR")[0]

                    bitvavo = Bitvavo({
                        'APIKEY': api_key,
                        'APISECRET': secret_key,
                        'RESTURL': 'https://api.bitvavo.com/v2',
                        'WSURL': 'wss://ws.bitvavo.com/v2/',
                        'ACCESSWINDOW': 10000,
                        'DEBUGGING': True
                    })
                    try:
                        balance = bitvavo.balance({})

                        for bal in balance:
                            if lastAsset == bal['symbol']:
                                assBalance = bal['available']
                                if assBalance == vorigeBalance:
                                    time.sleep(1)
                                    response = bitvavo.placeOrder(lastPair, 'sell', 'market',
                                                                  {'amount': str(assBalance)})
                    except Exception as e:
                        send_to_telegram(str(emailUser) + ': ' + str(e))
                        continue


def process_telegram_message(update, context):
    msg_content = update.message.text
    print(msg_content, datetime.datetime.now())

    db_operations(msg_content)
    place_order(msg_content)
    manage_sales(msg_content)


def initialize_bot():
    update_handler = Updater("6866912508:AAGhZQOhBC80xYs5h-t4bwy0xJJ70nOX0r4", use_context=True)
    dispatcher = update_handler.dispatcher

    msg_handler = MessageHandler(Filters.text & ~Filters.command, process_telegram_message)
    dispatcher.add_handler(msg_handler)

    update_handler.start_polling()
    update_handler.idle()


if __name__ == "__main__":
    initialize_bot()
