<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property integer $id_shop
 * @property integer $id_status
 * @property integer $id_order_shop
 * @property integer $id_currency_1
 * @property integer $id_currency_2
 * @property double $amount_1
 * @property double $amount_2
 * @property double $amount_paid
 * @property double $course
 * @property double $commission
 * @property double $volume_commission
 * @property string $adress
 * @property string $hash
 * @property integer $count_confirm
 * @property string $email
 * @property string $note
 * @property integer $is_active
 * @property string $create_date
 * @property string $mod_date
 */
class WobOrders extends WobActiveRecord
{
	const STATUS_NEW		= 1; // статус заказа новый
	const STATUS_READY		= 2; // статус заказа завершен
	const STATUS_MIN		= 3; // статус заказа не достаточная сумма
	const STATUS_CONFIRM 	= 4; // статус заказа не достаточное количество подтверждений
	const STATUS_FINISH 	= 5; // статус заказа средства по заказу зачислены на счет

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_shop, amount_2, create_date, mod_date', 'required'),
			array('id_shop, id_status, id_order_shop, id_currency_1, id_currency_2, count_confirm, is_active', 'numerical', 'integerOnly'=>true),
			array('amount_1, amount_2, amount_paid, course, commission, volume_commission', 'numerical'),
			array('adress, email', 'length', 'max'=>1024),
			array('hash', 'length', 'max'=>128),
			array('note', 'length', 'max'=>2048),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_shop, id_status, id_order_shop, id_currency_1, id_currency_2, amount_1, amount_2, amount_paid, course, commission, volume_commission, adress, hash, count_confirm, email, note, is_active, create_date, mod_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'shop'=>array(self::BELONGS_TO, 'WobShops', 'id_shop'),
			'currency_1'=>array(self::BELONGS_TO, 'WobCurrency', 'id_currency_1'),
			'currency_2'=>array(self::BELONGS_TO, 'WobCurrency', 'id_currency_2'),
			'status'=>array(self::BELONGS_TO, 'WobOrdersStatus', 'id_status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => WobModule::t('main', 'ID'),
			'id_shop' => WobModule::t('main', 'Id Shop'),
			'id_status' => WobModule::t('main', 'Id Status'),
			'id_order_shop' => WobModule::t('main', 'Id Order Shop'),
			'id_currency_1' => WobModule::t('main', 'Id Currency 1'),
			'id_currency_2' => WobModule::t('main', 'Id Currency 2'),
			'amount_1' => WobModule::t('main', 'Payable'),
			'amount_2' => WobModule::t('main', 'Price in store'),
			'amount_paid' => WobModule::t('main', 'Amount Paid'),
			'course' => WobModule::t('main', 'Course'),
			'commission' => WobModule::t('main', 'Commission'),
			'volume_commission' => WobModule::t('main', 'Volume Commission'),
			'adress' => WobModule::t('main', 'Adress'),
			'hash' => WobModule::t('main', 'Hash'),
			'count_confirm' => WobModule::t('main', 'Count Confirm'),
			'email' => WobModule::t('main', 'Email'),
			'note' => WobModule::t('main', 'Note'),
			'is_active' => WobModule::t('main', 'Is Active'),
			'create_date' => WobModule::t('main', 'Create Date'),
			'mod_date' => WobModule::t('main', 'Mod Date'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_shop',$this->id_shop);
		$criteria->compare('id_status',$this->id_status);
		$criteria->compare('id_order_shop',$this->id_order_shop);
		$criteria->compare('id_currency_1',$this->id_currency_1);
		$criteria->compare('id_currency_2',$this->id_currency_2);
		$criteria->compare('amount_1',$this->amount_1);
		$criteria->compare('amount_2',$this->amount_2);
		$criteria->compare('amount_paid',$this->amount_paid);
		$criteria->compare('course',$this->course);
		$criteria->compare('commission',$this->commission);
		$criteria->compare('volume_commission',$this->volume_commission);
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('count_confirm',$this->count_confirm);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('mod_date',$this->mod_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WobOrders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function afterValidate()
	{
		parent::afterValidate();
		if ($this->isNewRecord and count($this->getErrors())==0) {
			$shop=WobShops::model()->findByPk($this->id_shop);
			if ($shop===null) {
				$this->addError('id_shop', WobModule::t('main', 'Shop in the system is not found'));
			}
		}
	}

	protected function afterSave()
	{
		parent::afterSave();
		if ($this->isNewRecord) {
			$this->setHash();
		}
	}

	/**
	 * установит хеш для заявки
	 */
	public function setHash()
	{
		$this->hash = md5($this->id);
		$this->updateByPk($this->id, array('hash'=>$this->hash));
	}

	/**
	 * отправляет email
	 */
	public function sendMail()
	{
		if (!empty($this->email)) {
			$subject = '';
			$message = '';
			$view = false;
			if (Wob::module()->mail_new_client) {
				if ($this->id_status == self::STATUS_NEW) {
					$subject = WobModule::t('main', 'You passed for payment');
					$message = array(
						'shop_name'=>$this->shop->name,
						'amount'=>ViewPrice::format($this->amount_1, $this->currency_1->code, $this->currency_1->round),
						'order_hash'=>$this->hash,
					);
					$view = 'new_order_client';
				}
				if ($this->id_status == self::STATUS_READY) {
					$subject = WobModule::t('main', 'You paid the order');
					$message = array(
						'shop_name'=>$this->shop->name,
						'amount'=>ViewPrice::format($this->amount_1, $this->currency_1->code, $this->currency_1->round),
					);
					$view = 'finish_order_client';
				}
			}
			if (!empty($subject) and !empty($message))
				Wob::mail()->send($this->email, $subject, $message, $view);
		}
		if (!empty($this->shop->email_admin)) {
			$subject = '';
			$message = '';
			$view = false;
			if (Wob::module()->mail_new_admin and $this->id_status == self::STATUS_READY) {
				$subject = WobModule::t('main', 'Payment in your store');
				$message = array(
					'shop_name'=>$this->shop->name,
					'id_order_shop'=>$this->id_order_shop,
					'email'=>$this->email,
					'amount'=>ViewPrice::format($this->amount_1, $this->currency_1->code, $this->currency_1->round),
				);
				$view = 'finish_order_admin';
			}
			if (!empty($subject) and !empty($message))
				Wob::mail()->send($this->shop->email_admin, $subject, $message, $view);
		}
	}

	/**
	 * вернет список заявок для магазина
	 * @param $id_shop
	 * @return CActiveDataProvider
	 */
	public function getListByShop($id_shop)
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('currency_1', 'currency_2', 'status');
		$criteria->condition = 'id_shop=:id_shop';
		$criteria->params = array(
			':id_shop'=>$id_shop,
		);
		if (!isset($_GET['WobOrders_sort']))
			$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * выставит счет
	 * @param $param
	 * @return bool
	 */
	public function addOrder($param)
	{
		$this->attributes=$param;

		if (isset($param['merchant_id']))
			$this->id_shop = $param['merchant_id'];
		if (isset($param['amount']))
			$this->amount_2 = $param['amount'];
		if (isset($param['currency_code']) and !empty($param['currency_code'])) {
			$currency = WobCurrency::model()->find('code=:code', array(':code'=>$param['currency_code']));
			if ($currency===null) {
				$this->addError('id_currency_2', WobModule::t('main', 'This currency is not found'));
				return false;
			}
			$this->id_currency_2 = $currency->id;
		} else {
			//если валюта не была указана нужно посмотреть в настройках магазина
			$shop = WobShops::model()->findByPk($this->id_shop);
			if ($shop===null) {
				$this->addError('id_shop', WobModule::t('main', 'Shop in the system is not found'));
				return false;
			}
			if (empty($shop->id_currency_2)) {
				$this->addError('id_currency_2', WobModule::t('main', 'Not specified currency'));
				return false;
			}
			$this->id_currency_2 = $shop->id_currency_2;
		}
		if (isset($param['currency_code_pay']) and !empty($param['currency_code_pay'])) {
			$currency = WobCurrency::model()->pay()->find('code=:code', array(':code'=>$param['currency_code_pay']));
			if ($currency!==null) {
				if ($this->setPayCurrency($currency->id))
					return true;
				else
					return false;
			}
		}

		if ($this->save()) {
			return true;
		}
		return false;
	}

	/**
	 * установит валюту которой оплачиваем
	 * @param $id_currency
	 * @return bool
	 */
	public function setPayCurrency($id_currency)
	{
		if ($this->isCurrencyPay($id_currency)===false) {
			$this->addError('id_currency_1', WobModule::t('main', 'This currency is not available for payments'));
			return false;
		}

		$currency_1 = WobCurrency::model()->findByPk($id_currency);
		if ($currency_1===null) {
			$this->addError('id_currency_1', WobModule::t('main', 'System error. Please try again later.'));
			return false;
		}

		$shop = $this->shop;
		if ($shop===null) {
			$shop = WobShops::model()->findByPk($this->id_shop);
			if ($shop===null) {
				$this->addError('id_shop', WobModule::t('main', 'Shop in the system is not found'));
				return false;
			}
		}

		$address = Wob::wallet($currency_1->code)->getNewAddress($shop->id_user);
		if ($address===false) {
			$this->addError('adress', WobModule::t('main', 'System error. Please try again later.'));
			return false;
		}

		$old_currency = $this->id_currency_1;
		$this->id_currency_1 = $currency_1->id;
		$this->adress = $address;

		if ($this->save()) {
			$this->updateAmount();
			// если способ оплаты выбрали впервые отправляем email
			if (empty($old_currency))
				$this->sendMail();
			return true;
		}
		return false;
	}

	/**
	 * обновит сумму оплаты по курсу
	 * @return bool
	 */
	public function updateAmount()
	{
		$pair = WobPair::model()->find('id_currency_1=:id_currency_1 AND id_currency_2=:id_currency_2', array(
			':id_currency_1'=>$this->id_currency_1,
			':id_currency_2'=>$this->id_currency_2,
		));

		if ($pair===null) {
			Wob::log(__CLASS__ . ' not pair', __METHOD__);
			return false;
		}

		$this->course = $pair->course;
		$this->amount_1 = $this->amount_2 / $this->course;
		// округление в большую сторону
		$this->amount_1 = ceil($this->amount_1 * pow(10, 8)) / pow(10, 8);
		$this->commission = $this->shop->commission;
		$this->volume_commission = 0;
		// если коммисию берем с пользователя то к стоимости нужно добавить размер коммиссии
		if ($this->shop->is_commission_shop==0) {
			$this->volume_commission = $this->amount_1 * $this->commission / 100;
			$this->amount_1 = $this->amount_1 + $this->volume_commission;
			$this->amount_1 = ceil($this->amount_1 * pow(10, 8)) / pow(10, 8);
		}

		if ($this->save()) {
			return true;
		}
		return false;
	}

	/**
	 * вернет пары валют которыми можно оплатить заказ
	 * @return mixed
	 */
	public function getPairsPay()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_currency_2=:id_currency_2';
		$criteria->params = array(
			':id_currency_2'=>$this->id_currency_2
		);
		//если в настройках магазина указано чем именно будет принимать
		$in = $this->shop->getCurrencyPay();
		if (count($in)>0)
			$criteria->addInCondition('id_currency_1', $in);
		$criteria->scopes='pay';
		$pairs = WobPair::model()->findAll($criteria);
		return $pairs;
	}

	/**
	 * признак возможно ли оплатить заказ указанной валютой
	 * @param $id_currency
	 * @return bool
	 */
	public function isCurrencyPay($id_currency)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_currency_1=:id_currency_1 AND id_currency_2=:id_currency_2';
		$criteria->params = array(
			':id_currency_1'=>(int)$id_currency,
			':id_currency_2'=>$this->id_currency_2
		);
		//если в настройках магазина указано чем именно будет принимать
		$in = $this->shop->getCurrencyPay();
		if (count($in)>0)
			$criteria->addInCondition('id_currency_1', $in);
		$criteria->scopes='pay';
		$pair = WobPair::model()->find($criteria);
		if ($pair!==null) {
			return true;
		}
		return false;
	}

	/**
	 * проверяет новый статус и выставляет его
	 * @return bool
	 */
	public function setStatusPay()
	{
		// если статус уже завершен
		if ($this->id_status == self::STATUS_READY or $this->id_status == self::STATUS_FINISH) {
			return true;
		}

		$wallet = Wob::wallet($this->currency_1->code);

		// получаем сумму которая пришла на кошелек
		$summa_pay = (float)$wallet->getReceivedByAddress((string)$this->adress);
		$this->amount_paid = $summa_pay;
		// если поступил платеж, но сумма меньше чем в заказе
		if ($summa_pay > 0 and $summa_pay < $this->amount_1) {
			$this->id_status = self::STATUS_MIN;
		} elseif ($summa_pay > 0) { // если сумма больше 0 нужно проверить статус
			// получаем все транзакции аккаунта, среди них должна быть с адресов нашей заявки
			$list = $wallet->listTransactions((string)$this->shop->id_user);
			foreach ($list as $value) {
				// если адресс транзакции и адрес заказа совпадает, и транзакция по оплате
				if ($value['address']==$this->adress and $value['category']=='receive') {
					// если было больше 6 подтверждений
					if ($value['confirmations']>=$wallet->getCountConfirm()) {
						// ставим заказу статус завершен
						$this->id_status = self::STATUS_READY;
						// нужно в магазин отправить запрос, то что заказ оплачен
						Wob::sendShop($this->id);
						// отправляем email о завершенной оплате
						$this->sendMail();
					} else {
						// ставим заказу статус еще недостаточное количество подтверждений
						$this->id_status = self::STATUS_CONFIRM;
					}
					// указываем сколько было подтверждений
					$this->count_confirm = $value['confirmations'];
					// транзакцию нашли дальше можно не искать
					break;
				}
			}
		}
		if ($this->save()) {
			return true;
		}
		Wob::log(__CLASS__ . ' not save: '. $this->id, __METHOD__);
		return false;
	}

	/**
	 * проверяет новый статус и выставляет его
	 * @return bool
	 */
	public function setStatusFinish()
	{
		if ($this->id_status != self::STATUS_READY) {
			return false;
		}

		$transaction = Yii::app()->db->beginTransaction();
		try {
			$paid = $this->amount_paid - $this->volume_commission;
			if (WobUsersWallet::up($this->shop->id_user, $paid, $this->id_currency_1)) {
				$this->id_status = self::STATUS_FINISH;
				if ($this->save()) {
					$transaction->commit();
					return true;
				}
				Wob::log(__CLASS__ . " not save: " . $this->id, __METHOD__);
				$transaction->rollBack();
			}
		} catch (Exception $e) {
			Wob::log(__CLASS__ . $e->getMessage(), __METHOD__);
			$transaction->rollBack();
		}

		return false;
	}
}
