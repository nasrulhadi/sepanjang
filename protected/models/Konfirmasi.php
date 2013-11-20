<?php

/**
 * This is the model class for table "konfirmasi".
 *
 * The followings are the available columns in table 'konfirmasi':
 * @property integer $knf_id
 * @property integer $ord_id
 * @property string $knf_date
 * @property string $knf_buyer
 * @property integer $knf_nominal
 */
class Konfirmasi extends CActiveRecord
{
	public $verifyCode;
	public $nomor;
	public $bank;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'konfirmasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('ord_id, knf_date, knf_buyer, knf_nominal', 'required'),
			array('ord_id, nomor, knf_nominal', 'numerical', 'integerOnly'=>true, 'message'=>'{attribute} harus diisi angka'),
			array('knf_buyer', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('knf_id, ord_id, knf_date, knf_buyer, knf_nominal', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'{attribute} tidak benar'),
			array('knf_buyer, nomor, knf_nominal, bank, knf_date', 'required', 'message'=>'{attribute} tidak boleh kosong'),
			array('ord_id', 'cekOrder'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'knf_id' => 'Knf',
			'ord_id' => 'Ord',
			'knf_date' => 'Knf Date',
			'knf_buyer' => 'Nama Pembeli',
			'knf_nominal' => 'Nominal',
			'verifyCode'=>'Anti Spam',
			'nomor' => 'Nomor Telepon'
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

		$criteria->compare('knf_id',$this->knf_id);
		$criteria->compare('ord_id',$this->ord_id);
		$criteria->compare('knf_date',$this->knf_date,true);
		$criteria->compare('knf_buyer',$this->knf_buyer,true);
		$criteria->compare('knf_nominal',$this->knf_nominal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Konfirmasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function cekOrder($attribute,$params)
	{
		if($this->knf_date == "kemarin"){
			$tanggal = date('Y-m-d', time() - ((60*60*24)*1));
		}else{
			$tanggal = date('Y-m-d');			
		}

		$criteria=new CDbCriteria;
	   	$criteria->condition = "ord_dest = '".$this->nomor."' AND ord_bank = '".$this->bank."' AND dnm_nominal = '".$this->knf_nominal."' AND DATE(ord_date) = '".$tanggal."'";

		$periksa = Order::model()->findAll($criteria);

		if(count($periksa) == 0){
			if($this->nomor != "" && $this->knf_buyer != "" && $this->knf_nominal != ""){
				$this->addError('ord_id', 'Kami tidak bisa menemukan rincian Order seperti yang diminta, tolong bantu kami untuk memasukan data dengan benar.');
			}
		}
	}
}
