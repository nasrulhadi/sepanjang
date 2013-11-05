<?php

/**
 * This is the model class for table "options".
 *
 * The followings are the available columns in table 'options':
 * @property integer $sys_id
 * @property string $sys_name
 * @property string $sys_value
 * @property integer $sys_status
 */
class Options extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sys_name, sys_value', 'required'),
			array('sys_status', 'numerical', 'integerOnly'=>true),
			array('sys_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sys_id, sys_name, sys_value, sys_status', 'safe', 'on'=>'search'),
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
			'sys_id' => 'Sys',
			'sys_name' => 'Sys Name',
			'sys_value' => 'Sys Value',
			'sys_status' => 'Sys Status',
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

		$criteria->compare('sys_id',$this->sys_id);
		$criteria->compare('sys_name',$this->sys_name,true);
		$criteria->compare('sys_value',$this->sys_value,true);
		$criteria->compare('sys_status',$this->sys_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Options the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function getOptions($name)
	{
		$getData = Options::model()->find('sys_name = :sysName', array(':sysName' => $name));

		if(isset($getData))
		{
			if($getData->sys_status == 1 && $getData->sys_value != "" && $getData->sys_value != null)
			{
				// aktif dan value tidak kosong
				return $getData->sys_value;	
			} else {
				// nonaktif dan value kosong
				return null;
			}
		} else {
			return null;
		}
	}

	public function getSession() 
	{
	    $pass = array();
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789"; 
	    $alphaLength = strlen($alphabet) - 1;

	    for ($i = 0; $i < 8; $i++) 
	    {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass);
	}

}
